<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentSuccessNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $reservation;
    protected $payment;

    /**
     * Create a new notification instance.
     */
    public function __construct($reservation, $payment)
    {
        $this->reservation = $reservation;
        $this->payment = $payment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $serviceAmount = $this->reservation->harga;
        $tax = round($serviceAmount * 0);
        $discount = $this->payment->discount_amount ?? 0;
        $totalAmount = $serviceAmount + $tax - $discount;

        return (new MailMessage)
            ->subject('Pembayaran Berhasil - BabySpa')
            ->view('templates.email', [
                'customerName' => $notifiable->name,
                'reservationId' => $this->reservation->kode,
                'serviceName' => $this->reservation->type === 'layanan' 
                    ? $this->reservation->layanan->nama_layanan 
                    : $this->reservation->paketLayanan->nama_paket,
                'childName' => $this->reservation->bayi->nama,
                'appointmentDate' => \Carbon\Carbon::parse($this->reservation->tanggal_reservasi)
                    ->locale('id')
                    ->isoFormat('D MMMM Y'),
                'appointmentTime' => $this->reservation->sesi->jam,
                'location' => 'Jl. Perjuangan Baru No.2, Gn. Pangilun',
                'serviceAmount' => $serviceAmount,
                'tax' => $tax,
                'discount' => $discount,
                'totalAmount' => $totalAmount,
                'paymentMethod' => $this->payment->metode
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
