<?php

namespace App\Filament\Resources;

use App\Domain\Seo\Models\Redirect;
use App\Filament\Resources\SeoRedirectResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SeoRedirectResource extends Resource
{
    protected static ?string $model = Redirect::class;
    protected static ?string $navigationIcon = 'heroicon-o-arrow-top-right-on-square';
    protected static ?string $navigationGroup = 'SEO';
    protected static ?string $label = 'Редирект';
    protected static ?string $pluralLabel = 'Редиректы';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Редирект')->schema([
                Forms\Components\TextInput::make('from_path')->label('Откуда')->required()
                    ->placeholder('/old-path'),
                Forms\Components\TextInput::make('to_path')->label('Куда')->required()
                    ->placeholder('/new-path'),
                Forms\Components\Select::make('code')->label('Код')->options([
                    301 => '301 Permanent',
                    302 => '302 Temporary',
                ])->default(301)->required(),
                Forms\Components\Toggle::make('is_active')->label('Активен')->inline(false)->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('from_path')->label('Откуда')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('to_path')->label('Куда')->searchable(),
                Tables\Columns\TextColumn::make('code')->label('Код')->badge(),
                Tables\Columns\IconColumn::make('is_active')->label('Активен')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->label('Создан')->date('d.m.Y')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSeoRedirects::route('/'),
            'create' => Pages\CreateSeoRedirect::route('/create'),
            'edit'   => Pages\EditSeoRedirect::route('/{record}/edit'),
        ];
    }
}
