<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CoursResource\Pages;
use App\Filament\Resources\CoursResource\RelationManagers;
use App\Models\Cours;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CoursResource extends Resource
{
    protected static ?string $model = Cours::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationLabel = 'Mes cours';

    protected static ?string $navigationGroup = 'Gestion des ressources';

    protected static ?int $navigationSort = 7;


    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('title')
                ->label('Titre')
                ->required()
                ->maxLength(255),
            Forms\Components\Textarea::make('description')
            ->label('Description')
                ->required()
                ->columnSpanFull(),
            Forms\Components\RichEditor::make('resume')
                ->label('Résumé')
                ->required()
                ->columnSpanFull(),
            Forms\Components\RichEditor::make('content')
                ->label('Contenu')
                ->required()
                ->columnSpanFull(),
            Forms\Components\FileUpload::make('image')
                ->label('Image')
                ->image(),
            Forms\Components\FileUpload::make('file')
                ->label('Fichier')
                ->acceptedFileTypes(['application/pdf'])
                ->maxSize(99999),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\ImageColumn::make('image')->label('Image'),
            Tables\Columns\TextColumn::make('title')
                ->label('Titre')
                ->searchable(),
            Tables\Columns\TextColumn::make('resume')
                ->label('Resumé')
                ->limit(80)
                ->searchable(),
            Tables\Columns\TextColumn::make('file_size')
                ->label('Taille du fichier')
                ->searchable(),
            Tables\Columns\ToggleColumn::make('archive')
            ->label('Archive')
            ->onIcon('heroicon-s-check')
            ->offIcon('heroicon-o-x-circle')
            ->default(false)
            ->beforeStateUpdated(function ($record, $state) {
                // Runs before the state is saved to the database.
            })
            ->afterStateUpdated(function ($record, $state) {
                $record->archive = $state ? 1 : 0;
                $record->save();
            }),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('deleted_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListCours::route('/'),
            'create' => Pages\CreateCours::route('/create'),
            'view' => Pages\ViewCours::route('/{record}'),
            'edit' => Pages\EditCours::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
