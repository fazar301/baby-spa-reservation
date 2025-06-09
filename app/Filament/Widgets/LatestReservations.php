<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Reservation;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestReservations extends BaseWidget
{
    protected static ?string $heading = 'Reservasi Terbaru';
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Reservation::query()
                    ->latest('tanggal_reservasi')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('kode')
                    ->label('Kode Reservasi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Orang Tua')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.noHP')
                    ->label('Nomor Telepon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('layanan.nama_layanan')
                    ->label('Layanan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bayi.nama')
                    ->label('Nama Bayi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_reservasi')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->searchable(query: function (Builder $query, string $search) {
                        $query->where(function (Builder $subQuery) use ($search) {
                            // 1. Cek apakah search adalah format "d M" (contoh: "25 Jan")
                            try {
                                $parsedDate = Carbon::createFromFormat('d M', $search);
                                $subQuery->whereDay('tanggal_reservasi', $parsedDate->day)
                                          ->whereMonth('tanggal_reservasi', $parsedDate->month);
                            } catch (\Exception $e) {
                                // 2. Jika bukan "d M", cek apakah search mengandung nama bulan (Indonesia)
                                $monthMap = [
                                    'jan' => 1, 'januari' => 1,
                                    'feb' => 2, 'februari' => 2,
                                    'mar' => 3, 'maret' => 3,
                                    'apr' => 4, 'april' => 4,
                                    'mei' => 5,
                                    'jun' => 6, 'juni' => 6,
                                    'jul' => 7, 'juli' => 7,
                                    'agu' => 8, 'agustus' => 8,
                                    'sep' => 9, 'september' => 9,
                                    'okt' => 10, 'oktober' => 10,
                                    'nov' => 11, 'november' => 11,
                                    'des' => 12, 'desember' => 12,
                                ];
                
                                $searchLower = strtolower($search);
                                $foundMonth = null;
                
                                // Cek apakah search adalah nama bulan (full atau singkatan)
                                foreach ($monthMap as $monthName => $monthNumber) {
                                    if (str_contains($searchLower, $monthName)) {
                                        $foundMonth = $monthNumber;
                                        break;
                                    }
                                }
                
                                if ($foundMonth) {
                                    $subQuery->whereMonth('tanggal_reservasi', $foundMonth);
                                } else {
                                    // 3. Fallback: Pencarian biasa (angka atau format default)
                                    $subQuery->orWhere('tanggal_reservasi', 'LIKE', "%{$search}%");
                                }
                            }
                        });
                    })   
                    ->sortable(),
                Tables\Columns\TextColumn::make('sesi.jam')
                    ->label('Waktu')
                    ->time('H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                        'completed' => 'info',
                        default => 'gray',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'pending' => 'heroicon-s-clock',
                        'confirmed' => 'heroicon-s-check-circle',
                        'cancelled' => 'heroicon-s-x-circle',
                        'completed' => 'heroicon-s-clipboard-document-check',
                        default => 'heroicon-s-information-circle',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('tanggal_reservasi', 'desc')
            ->paginated(true);
    }
}
