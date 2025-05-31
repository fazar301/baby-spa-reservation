<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OauthController;
use App\Models\Layanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\LayananController;
use App\Models\PaketLayanan;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PaymentController;
use Filament\Notifications\Notification;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    $layanans = Layanan::limit(3)->get();
    $paket_layanans = PaketLayanan::limit(3)->with('layanans')->get();
    return view('front.home', ['layanans' => $layanans, 'paket_layanans' => $paket_layanans]);
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/reservasi', function () {
    $layanans = Layanan::all();
    $paketLayanans = PaketLayanan::all();
    return view('dashboard_user.reservasi', compact('layanans', 'paketLayanans'));
})->middleware(['auth', 'verified'])->name('reservasi');

Route::get('/transaksi', function () {
    $user = auth()->user();
    
    // Calculate Total Spending
    $totalSpending = \App\Models\Transaksi::whereHas('reservasi', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->where('status', 'paid')
        ->sum('jumlah');

    // Calculate This Month Spending
    $thisMonthSpending = \App\Models\Transaksi::whereHas('reservasi', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->where('status', 'paid')
        ->whereMonth('tanggal', \Carbon\Carbon::now()->month)
        ->whereYear('tanggal', \Carbon\Carbon::now()->year)
        ->sum('jumlah');

    // Calculate Last Month Spending
    $lastMonth = \Carbon\Carbon::now()->subMonth();

    $lastMonthSpending = \App\Models\Transaksi::whereHas('reservasi', function($query) use ($user) {
        $query->where('user_id', $user->id);
    })
    ->where('status', 'paid')
    ->whereMonth('tanggal', $lastMonth->month)
    ->whereYear('tanggal', $lastMonth->year)
    ->sum('jumlah');


    // Get Last Transaction
    $lastTransaction = \App\Models\Transaksi::whereHas('reservasi', function($query) use ($user) {
        $query->where('user_id', $user->id);
    })
    ->where('status', 'paid')
    ->orderBy('tanggal', 'desc')
    ->first();

    $transactions = $user
        ->reservasis()
        ->with('transaksi')
        ->with('layanan')
        ->get()
        ->pluck('transaksi')
        ->flatten()
        ->map(function ($transaction) {
            return [
                'id' => $transaction->reservasi->id,
                'kode' => $transaction->reservasi->kode,
                'date' => $transaction->created_at->format('d F Y'),
                'service' => $transaction->reservasi->layanan->nama_layanan, // or from transaction if it exists there
                'amount' => 'Rp ' . number_format($transaction->jumlah, 0, ',', '.'),
                'status' => $transaction->status,
                'statusText' => $transaction->status === 'paid' ? 'Lunas' : 'Dibatalkan',
                'method' => strtoupper($transaction->metode)
            ];
    });
    return view('dashboard_user.transaksi', compact('transactions', 'totalSpending', 'thisMonthSpending', 'lastMonthSpending', 'lastTransaction'));
})->middleware(['auth', 'verified'])->name('transaksi');

Route::get('/settings', function () {  
    $user = Auth::user();
    return view('dashboard_user.setting', compact('user'));
})->middleware(['auth', 'verified'])->name('settings');

Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');

Route::get('oauth/google', [OauthController::class, 'redirectToProvider'])->name('oauth.google');  
Route::get('oauth/google/callback', [OauthController::class, 'handleProviderCallback'])->name('oauth.google.callback');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/logout', function(){
    Auth::logout();
    return redirect('/login');
});
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Reservation routes
Route::middleware(['auth'])->group(function () {
    // Get service ID from URL and show reservation form
    Route::get('/reservasi/create/{type}/{slug}', [ReservationController::class, 'create'])
        ->name('reservasi.create')
        ->where('type', 'layanan|paket');
    
    // Store the reservation
    Route::post('/reservasi', [ReservationController::class, 'store'])
        ->name('reservasi.store');
    
    // Success page
    Route::get('/reservasi/success', [ReservationController::class, 'success'])
        ->name('reservasi.success');

    // Index page for reservations
    Route::get('/reservasi', [ReservationController::class, 'index'])
        ->name('reservasi.index');

    // API endpoint for checking available sessions
    Route::get('/api/available-sessions', [ReservationController::class, 'getAvailableSessions'])
        ->name('api.available-sessions');

    Route::get('/reservations/{reservation}/invoice', [ReservationController::class, 'downloadInvoice'])->name('reservasi.invoice');
    // Payment related routes (now handled by TransaksiController)
    Route::get('/reservations/{reservation}/payment', [TransaksiController::class, 'showPayment'])
        ->name('payment.show');
    Route::post('/reservations/{reservation}/apply-voucher', [TransaksiController::class, 'applyVoucher'])
        ->name('reservations.apply-voucher');
    Route::post('/payment/process', [TransaksiController::class, 'processPayment'])
        ->name('payment.process');
    Route::post('/payment/callback', [TransaksiController::class, 'handleCallback'])
        ->name('payment.callback');
});

// Add this route outside the auth middleware group
Route::get('/reservasi/redirect/{type}/{slug}', function ($type, $slug) {
    if (!Auth::check()) {
        session(['intended' => route('reservasi.create', ['type' => $type, 'slug' => $slug])]);
        return redirect()->route('login');
    }
    return redirect()->route('reservasi.create', ['type' => $type, 'slug' => $slug]);
})->name('reservasi.redirect')->where('type', 'layanan|paket');

// Payment Routes
Route::post('/payment/verify', [PaymentController::class, 'verify'])->name('payment.verify');
Route::post('/payment/notification', [PaymentController::class, 'handleNotification'])->name('payment.notification');
Route::post('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
Route::get('/reservasi/pending', [ReservationController::class, 'pending'])->name('reservasi.pending');

Route::get('/test-template', function(){
    return view('templates.invoice');
});

Route::get('/test-notification', function(){
    $recipient = Auth::user();
    Notification::make()
        ->title('Test Notification')
        ->body('This is a test notification')
        ->sendToDatabase($recipient);
    return redirect()->back()->with('success', 'Notification sent successfully');
});

// Notification routes
Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::delete('/notifications/delete-all', [NotificationController::class, 'deleteAll'])->name('notifications.deleteAll');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});

require __DIR__.'/auth.php';
