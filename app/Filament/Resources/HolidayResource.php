<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HolidayResource\Pages;
use App\Filament\Resources\HolidayResource\RelationManagers;
use App\Models\Holiday;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HolidayResource extends Resource
{
    protected static ?string $model = Holiday::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Hari Libur';
    protected static ?string $modelLabel = 'Hari Libur';
    protected static ?string $pluralModelLabel = 'Hari Libur';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationGroup = 'Manajemen Reservasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tanggal_mulai')
                    ->required()
                    ->label('Tanggal Mulai')
                    ->live()
                    ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                        self::checkAffectedReservations($state, $get('tanggal_selesai'), $set);
                    }),
                Forms\Components\DatePicker::make('tanggal_selesai')
                    ->required()
                    ->label('Tanggal Selesai')
                    ->live()
                    ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                        self::checkAffectedReservations($get('tanggal_mulai'), $state, $set);
                    })
                    ->rules([
                        function (Forms\Get $get) {
                            return function (string $attribute, $value, \Closure $fail) use ($get) {
                                $startDate = $get('tanggal_mulai');
                                if ($startDate && $value && strtotime($value) < strtotime($startDate)) {
                                    $fail('Tanggal selesai tidak boleh kurang dari tanggal mulai.');
                                }
                            };
                        },
                    ]),
                Forms\Components\Textarea::make('deskripsi')
                    ->required()
                    ->label('Deskripsi')
                    ->columnSpanFull(),
                Forms\Components\Placeholder::make('affected_reservations')
                    ->label('Reservasi yang Terdampak')
                    ->content(function ($get) {
                        $startDate = $get('tanggal_mulai');
                        $endDate = $get('tanggal_selesai');
                        
                        if (!$startDate || !$endDate) {
                            return 'Pilih tanggal mulai dan selesai untuk melihat reservasi yang terdampak';
                        }

                        $affectedReservations = \App\Models\Reservation::whereBetween('tanggal_reservasi', [
                            $startDate,
                            $endDate
                        ])
                        ->whereNotIn('status', ['completed', 'cancelled'])
                        ->get();

                        if ($affectedReservations->isEmpty()) {
                            return 'Tidak ada reservasi yang terdampak pada periode ini';
                        }

                        return view('filament.components.reservation-list', [
                            'reservations' => $affectedReservations
                        ]);
                    })
                    ->columnSpanFull(),
            ]);
    }

    protected static function checkAffectedReservations($startDate, $endDate, Forms\Set $set)
    {
        if (!$startDate || !$endDate) {
            return;
        }

        $affectedReservations = \App\Models\Reservation::whereBetween('tanggal_reservasi', [
            $startDate,
            $endDate
        ])
        ->whereNotIn('status', ['completed', 'cancelled'])
        ->get();

        if ($affectedReservations->isNotEmpty()) {
            $set('affected_reservations', view('filament.components.reservation-list', [
                'reservations' => $affectedReservations
            ])->render());
        }
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->date()
                    ->sortable()
                    ->label('Tanggal Mulai'),
                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->date()
                    ->sortable()
                    ->label('Tanggal Selesai'),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->searchable()
                    ->label('Deskripsi'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListHolidays::route('/'),
            'create' => Pages\CreateHoliday::route('/create'),
            'edit' => Pages\EditHoliday::route('/{record}/edit'),
        ];
    }
}
