<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Tambahkan log untuk debugging
        \Log::info('Session intended sebelum login:', ['intended' => $request->session()->get('intended')]);

        if ($request->session()->has('intended')) {
            $intendedUrl = $request->session()->get('intended');
            $request->session()->forget('intended');
            \Log::info('Redirect ke intended:', ['url' => $intendedUrl]);
            return redirect()->to($intendedUrl);
        }

        \Log::info('Tidak ada intended, redirect ke dashboard');
        return redirect()->route('dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
