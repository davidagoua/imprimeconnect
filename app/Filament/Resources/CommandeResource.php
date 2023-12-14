<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommandeResource\Pages;
use App\Filament\Resources\CommandeResource\RelationManagers;
use App\Models\Commande;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommandeResource extends Resource
{
    protected static ?string $model = Commande::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('client_nom')->label("Nom du client")->required(),
                Forms\Components\TextInput::make('contact')->label("Contact du client")->required(),
                Forms\Components\DatePicker::make('dealine')->label("Deadline"),
                Forms\Components\TextInput::make('lieu_livraison')->label("Lieu de livraison"),
                Forms\Components\Radio::make('format')->options([
                    'grd'=>'Grand format',
                    'pt'=>'Petit format',
                    'gtd'=>'GDT',
                ])->inline(),

                Forms\Components\Fieldset::make('Personnels')
                    ->schema([
                        Forms\Components\Select::make('conseiller_id')
                            ->options(User::role('reception')->get()->pluck('name','id'))
                            ->label('Conseiller'),
                        Forms\Components\Select::make('infographiste_id')
                            ->options(User::role('designer')->get()->pluck('name','id'))
                            ->label('Infographiste'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListCommandes::route('/'),
            'create' => Pages\CreateCommande::route('/create'),
            'edit' => Pages\EditCommande::route('/{record}/edit'),
        ];
    }
}
