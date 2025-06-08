@props(['reservations'])

<div class="space-y-2">
    <ul>
        @foreach($reservations as $reservation)
        <li>
            <span>Kode: {{ $reservation->kode }} - Tanggal: {{ $reservation->tanggal_reservasi->format('d/m/Y') }}</span>
        </li>
        @endforeach
    </ul>

</div> 