<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaketLayananResource\Pages;
use App\Filament\Resources\PaketLayananResource\RelationManagers;
use App\Models\PaketLayanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\CheckboxList;
use Pelmered\FilamentMoneyField\Forms\Components\MoneyInput;
use Pelmered\FilamentMoneyField\Tables\Columns\MoneyColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class PaketLayananResource extends Resource
{
    protected static ?string $model = PaketLayanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationGroup = 'Manajemen Layanan';
    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_paket')->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'Nama layanan sudah digunakan',
                    ])
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->hidden()
                    ->dehydrated(),
                MoneyInput::make('harga_paket')
                    ->decimals(0)
                    ->required()
                    ->afterStateHydrated(function ($component, $state) {
                        if ($state) {
                            $component->state($state);
                        }
                    })
                    ->dehydrateStateUsing(function ($state) {
                        if (is_string($state)) {
                            return (int) str_replace(['.', 'Rp', ' '], '', $state);
                        }
                        return $state;
                    }),
                Select::make('kategori_id')
                    ->relationship('kategori', 'nama_kategori')
                    ->required()
                    ->label('Kategori'),
                Textarea::make('deskripsi')
                    ->required(),
                FileUpload::make('image')
                    ->image()
                    ->maxSize(10000)
                    ->required()
                    ->visibility('public')
                    ->disk('public')
                    ->directory('paket-layanan-images'),
                CheckboxList::make('layanans')
                    ->relationship('layanans', 'nama_layanan')
                    ->required()
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_paket')
                    ->searchable(),
                MoneyColumn::make('harga_paket')
                    ->decimals(0)
                    ->currency('IDR')
                    ->locale('ID_id')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                TextColumn::make('kategori.nama_kategori')
                    ->label('Kategori'),
                TextColumn::make('deskripsi')
                    ->limit(50),
                ImageColumn::make('image')
                    ->disk('public')
                    ->square()
                    ->height(50),
                TextColumn::make('layanans.nama_layanan')
                    ->label('Layanan')
                    ->listWithLineBreaks()
                    ->limitList(3)
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
            'index' => Pages\ListPaketLayanans::route('/'),
            'create' => Pages\CreatePaketLayanan::route('/create'),
            'edit' => Pages\EditPaketLayanan::route('/{record}/edit'),
        ];
    }
}
