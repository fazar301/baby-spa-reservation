<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UlasanResource\Pages;
use App\Models\Ulasan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UlasanResource extends Resource
{
    protected static ?string $model = Ulasan::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationLabel = 'Ulasan';

    protected static ?string $modelLabel = 'Ulasan';

    protected static ?string $pluralModelLabel = 'Ulasan';

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationGroup = 'Manajemen Reservasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('reservasis_id')
                    ->relationship('reservasi', 'kode')
                    ->required()
                    ->label('Kode Reservasi'),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->label('Pengguna'),
                Forms\Components\TextInput::make('nama_layanan')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Layanan'),
                Forms\Components\Select::make('rating')
                    ->options([
                        1 => '⭐ 1 - Sangat Buruk',
                        2 => '⭐⭐ 2 - Buruk',
                        3 => '⭐⭐⭐ 3 - Cukup',
                        4 => '⭐⭐⭐⭐ 4 - Baik',
                        5 => '⭐⭐⭐⭐⭐ 5 - Sangat Baik',
                    ])
                    ->required()
                    ->label('Rating'),
                Forms\Components\Textarea::make('feedback')
                    ->maxLength(65535)
                    ->columnSpanFull()
                    ->label('Ulasan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reservasi.kode')
                    ->searchable()
                    ->sortable()
                    ->label('Kode Reservasi'),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Pelanggan'),
                Tables\Columns\TextColumn::make('nama_layanan')
                    ->searchable()
                    ->sortable()
                    ->label('Layanan'),
                Tables\Columns\TextColumn::make('rating')
                    ->sortable()
                    ->label('Rating')
                    ->formatStateUsing(fn (string $state): string => str_repeat('⭐', $state)),
                Tables\Columns\TextColumn::make('feedback')
                    ->limit(50)
                    ->searchable()
                    ->label('Ulasan'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->label('Tanggal'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('rating')
                    ->options([
                        1 => '⭐ 1 - Sangat Buruk',
                        2 => '⭐⭐ 2 - Buruk',
                        3 => '⭐⭐⭐ 3 - Cukup',
                        4 => '⭐⭐⭐⭐ 4 - Baik',
                        5 => '⭐⭐⭐⭐⭐ 5 - Sangat Baik',
                    ])
                    ->label('Rating'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListUlasans::route('/'),
            'create' => Pages\CreateUlasan::route('/create'),
            'edit' => Pages\EditUlasan::route('/{record}/edit'),
        ];
    }
    public static function canCreate(): bool
    {
       return false;
    }
}