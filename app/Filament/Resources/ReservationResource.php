<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Reservation;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ReservationResource\Pages;
use App\Filament\Resources\ReservationResource\RelationManagers;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Reservasi';
    protected static ?string $modelLabel = 'Reservasi';
    protected static ?string $pluralModelLabel = 'Reservasi';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Manajemen Reservasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('bayi_id')
                    ->relationship('bayi', 'nama')
                    ->required(),
                Forms\Components\Select::make('sesi_id')
                    ->relationship('sesi', 'jam')
                    ->required()
                    ->options(function (Forms\Get $get) {
                        $date = $get('tanggal_reservasi');
                        if (!$date) {
                            return \App\Models\Sesi::orderBy('jam')->pluck('jam', 'id');
                        }

                        // Get all sessions
                        $allSesis = \App\Models\Sesi::orderBy('jam')->get();
                        
                        // Get active reservations for the specific date (excluding cancelled ones and current reservation)
                        $bookedSessions = \App\Models\Reservation::where('tanggal_reservasi', $date)
                            ->whereNotIn('status', ['cancelled'])
                            ->where('id', '!=', $get('id')) // Exclude current reservation
                            ->pluck('sesi_id')
                            ->toArray();
                        
                        // Filter out booked sessions
                        return $allSesis->filter(function($sesi) use ($bookedSessions) {
                            return !in_array($sesi->id, $bookedSessions);
                        })->pluck('jam', 'id');
                    }),
                Forms\Components\DatePicker::make('tanggal_reservasi')
                    ->minDate(now()->today())
                    ->native(false)
                    ->closeOnDateSelection(true)
                    ->required()
                    ->live(), // Make it live to trigger session options update
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                        'completed' => 'Completed',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('harga')
                    ->required()
                    ->numeric(),
                Forms\Components\Textarea::make('catatan')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('tanggal_reservasi', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('kode')
                    ->label('Kode Reservasi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Pelanggan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.noHP')
                    ->label('No. Telepon')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bayi.nama')
                    ->label('Nama Bayi')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('layanan.nama_layanan')
                    ->label('Layanan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_reservasi')
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
                    ->label('Waktu Reservasi')
                    ->time('H:i')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'confirmed',
                        'danger' => 'cancelled',
                        'info' => 'completed',
                    ])
                    ->icon(fn (string $state): string => match ($state) {
                        'pending' => 'heroicon-s-clock',
                        'confirmed' => 'heroicon-s-check-circle',
                        'cancelled' => 'heroicon-s-x-circle',
                        'completed' => 'heroicon-s-clipboard-document-check',
                        default => 'heroicon-s-information-circle',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('harga')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                        'completed' => 'Completed',
                    ]),
                Tables\Filters\Filter::make('sesi_id')
                    ->form([
                        Forms\Components\Select::make('sesi_id')
                            ->relationship('sesi', 'jam')
                            ->required(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['sesi_id'],
                                fn (Builder $query, $sesi_id): Builder => $query->where('sesi_id', $sesi_id),
                            );
                    })
            ])
            ->actions([
                // Tables\Actions\ViewAction::make()
                //     ->modalContent(fn (Reservation $record): View => view(
                //         'filament.resources.reservation-resource.pages.view-reservation',
                //         ['reservation' => $record]
                //     )),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
       return false;
    }
}
