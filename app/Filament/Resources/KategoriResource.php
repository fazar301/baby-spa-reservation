<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriResource\Pages;
use App\Filament\Resources\KategoriResource\RelationManagers;
use App\Models\Kategori;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Collection;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;

class KategoriResource extends Resource
{
    protected static ?string $model = Kategori::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationGroup = 'Manajemen Layanan';
    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_kategori')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'Nama kategori ini sudah digunakan.',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_kategori')
                    ->searchable(),
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
                Tables\Actions\DeleteAction::make()
                    ->before(function (Tables\Actions\DeleteAction $action, Kategori $record) {
                        // Check if kategori is used in layanan
                        if ($record->layanans()->exists()) {
                            Notification::make()
                                ->title('Tidak Dapat Menghapus Kategori')
                                ->body('Kategori ini sedang digunakan oleh satu atau lebih layanan. Silakan ubah kategori layanan tersebut terlebih dahulu.')
                                ->danger()
                                ->send();
                            $action->cancel();
                        }

                        // Check if kategori is used in paket layanan
                        if ($record->paketLayanans()->exists()) {
                            Notification::make()
                                ->title('Tidak Dapat Menghapus Kategori')
                                ->body('Kategori ini sedang digunakan oleh satu atau lebih paket layanan. Silakan ubah kategori paket layanan tersebut terlebih dahulu.')
                                ->danger()
                                ->send();
                            $action->cancel();
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function (Tables\Actions\DeleteBulkAction $action, Collection $records) {
                            $usedKategoris = collect();
                            
                            foreach ($records as $record) {
                                if ($record->layanans()->exists() || $record->paketLayanans()->exists()) {
                                    $usedKategoris->push($record->nama_kategori);
                                }
                            }

                            if ($usedKategoris->isNotEmpty()) {
                                Notification::make()
                                    ->title('Tidak Dapat Menghapus Kategori')
                                    ->body('Kategori berikut sedang digunakan: ' . $usedKategoris->join(', ') . '. Silakan ubah kategori tersebut terlebih dahulu.')
                                    ->danger()
                                    ->send();
                                $action->cancel();
                            }
                        }),
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
            'index' => Pages\ListKategoris::route('/'),
            'create' => Pages\CreateKategori::route('/create'),
            'edit' => Pages\EditKategori::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withCount(['layanans', 'paketLayanans'])
            ->orderBy('created_at', 'desc');
    }

    protected function handleRecordDeletion(Model $record): void
    {
        if ($record->layanans()->exists() || $record->paketLayanans()->exists()) {
            Notification::make()
                ->title('Tidak Dapat Menghapus Kategori')
                ->body('Kategori ini sedang digunakan oleh layanan atau paket layanan. Silakan ubah kategori yang terkait terlebih dahulu.')
                ->danger()
                ->send();
            
            $this->halt();
        }

        parent::handleRecordDeletion($record);
    }
}
