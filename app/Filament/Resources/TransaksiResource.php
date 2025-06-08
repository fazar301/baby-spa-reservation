<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Transaksi;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Notifications\ReservationNotification;
use App\Filament\Resources\TransaksiResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TransaksiResource\RelationManagers;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationLabel = 'Transaksi';
    protected static ?string $modelLabel = 'Transaksi';
    protected static ?string $pluralModelLabel = 'Transaksi';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = 'Manajemen Reservasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('reservasi_id')
                    ->relationship('reservasi', 'id')
                    ->required(),
                Forms\Components\DateTimePicker::make('tanggal')
                    ->required(),
                Forms\Components\TextInput::make('jumlah')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('discount_amount')
                    ->numeric()
                    ->default(0),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'expired' => 'Expired',
                        'failed' => 'Failed',
                    ])
                    ->required()
                    ->disabled(fn (Transaksi $record) => $record?->metode !== 'cash')
                    ->afterStateUpdated(function ($state, Transaksi $record) {
                        if ($state === 'paid' && $record->metode === 'cash') {
                            $record->reservasi->update(['status' => 'confirmed']);

                            // Send notification to customer using Laravel Notification
                            $customer = $record->reservasi->user;
                            $customer->notify(new ReservationNotification(
                                'Pembayaran berhasil',
                                'Pembayaran untuk reservasi telah berhasil',
                                'success'
                            ));
                        }
                    }),
                Forms\Components\TextInput::make('metode')
                    ->required(),
                Forms\Components\TextInput::make('order_id')
                    ->maxLength(255),
                Forms\Components\TextInput::make('snap_token')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('tanggal', 'desc')
            ->columns([
                // Tables\Columns\TextColumn::make('id')
                //     ->label('ID')
                //     ->sortable(),
                Tables\Columns\TextColumn::make('reservasi.kode')
                ->label('Kode Reservasi')
                ->searchable(),
                Tables\Columns\TextColumn::make('reservasi.user.name')
                    ->label('Nama Pelanggan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('reservasi.layanan.nama_layanan')
                    ->label('Layanan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'paid',
                        'danger' => 'expired',
                        'danger' => 'failed',
                    ])
                    ->icon(fn (string $state): string => match ($state) {
                        'pending' => 'heroicon-s-clock',
                        'paid' => 'heroicon-s-check-circle',
                        'expired' => 'heroicon-s-x-circle',
                        'failed' => 'heroicon-s-exclamation-circle',
                        default => 'heroicon-s-information-circle',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('metode')
                    ->formatStateUsing(fn (string $state): string => strtoupper($state))
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
                        'paid' => 'Paid',
                        'expired' => 'Expired',
                        'failed' => 'Failed',
                    ]),
                Tables\Filters\SelectFilter::make('metode')
                    ->options([
                        'midtrans' => 'Midtrans',
                        'cash' => 'Cash',
                    ]),
                Tables\Filters\Filter::make('tanggal')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(fn (Transaksi $record) => $record->metode === 'cash'),
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
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
       return false;
    }
}
