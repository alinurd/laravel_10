<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Param;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TernaryFilter;
use App\Filament\Resources\ParamResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ParamResource\RelationManagers;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;

class ParamResource extends Resource
{
    protected static ?string $model = Param::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                ->schema([
                    TextInput::make('pid')->required(),
                    TextInput::make('categori')->required(),
                    TextInput::make('data')->required()->unique(ignorable:fn($record)=>$record),
                    Select::make('status')
                        ->options([
                            'active'=> 'Active',
                            'inactive'=> 'Non-Active',
                            'show'=> 'Tampilkan',
                        ]),
                ])
                ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pid')->sortable()->searchable(),
                TextColumn::make('categori')->sortable()->searchable(),
                TextColumn::make('data')->sortable()->searchable(),
                TextColumn::make('status')->sortable()->searchable(),
            ])
            ->filters([
                TextConstraint::make('data'),
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
            'index' => Pages\ListParams::route('/'),
            'create' => Pages\CreateParam::route('/create'),
            'edit' => Pages\EditParam::route('/{record}/edit'),
        ];
    }
}
