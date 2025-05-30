<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Filament\Resources\ReservationResource\RelationManagers;
use App\Models\Reservation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Contracts\View\View;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Reservasi';
    protected static ?string $modelLabel = 'Reservasi';
    protected static ?string $pluralModelLabel = 'Reservasi';
    protected static ?int $navigationSort = 1;

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
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Pelanggan')
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
                Tables\Actions\ViewAction::make()
                    ->modalContent(fn (Reservation $record): View => view(
                        'filament.resources.reservation-resource.pages.view-reservation',
                        ['reservation' => $record]
                    )),
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
}
