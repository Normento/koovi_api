<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Email;
use Filament\Forms\Form;
use App\Models\Newsletter;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\EmailResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EmailResource\RelationManagers;
use Illuminate\Database\Eloquent\Model;

class EmailResource extends Resource
{
    protected static ?string $model = Email::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationGroup = 'Communication';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Grid::make()
                ->columns(1) // 1 colonne pour que tout prenne la largeur
                ->schema([
                    TextInput::make('subject')
                        ->label('Sujet')
                        ->required()
                        ->maxLength(255),

                    RichEditor::make('content')
                        ->label('Contenu')
                        ->required(),

                    Toggle::make('all')
                    ->label('Tout Sélectionner')
                    ->default(false)
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('newsletters', $state ? Newsletter::all()->pluck('id')->toArray() : []);
                    }),

                    Select::make('newsletters')
                        ->label('Destinataires')
                        ->relationship('newsletters', 'email')
                        ->options(Newsletter::all()->pluck('email', 'id')->toArray())
                        ->searchable()
                        ->multiple()
                        ->placeholder('Sélectionnez les abonnés à qui envoyer l\'email')
                        ->required(),

                        DateTimePicker::make('scheduled_at')
                        ->label('Sélectionnez la date et l\'heure de l\'envoi')
                        ->nullable()
                        ->seconds(false)
                        ->placeholder('Sélectionnez la date et l\'heure de l\'envoi'),
                ]),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('subject')
                ->label('Sujet')
                ->searchable()
                ->sortable(),
            IconColumn::make('status')
                ->label('Status')
                ->icon(fn ($state) => self::getIconForStatus($state))
                ->sortable(),
            TextColumn::make('created_at')
                ->label('Date de création')
                ->dateTime('d/m/Y H:i')
                ->sortable(),
        ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Filter::make('Envoyé')
                ->query(fn($query) => $query->where('sent', true))
                ->toggle(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListEmails::route('/'),
            'create' => Pages\CreateEmail::route('/create'),
            'edit' => Pages\EditEmail::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }


    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function getIconForStatus($status)
{
    return match ($status) {
        'sent' => 'heroicon-o-check-circle',
        'scheduled' => 'heroicon-o-clock',
        default => 'heroicon-o-clock',
    };
}




}
