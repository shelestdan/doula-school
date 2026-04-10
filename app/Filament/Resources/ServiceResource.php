<?php

namespace App\Filament\Resources;

use App\Domain\Services\Models\Service;
use App\Filament\Resources\ServiceResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Контент';
    protected static ?string $label = 'Услуга';
    protected static ?string $pluralLabel = 'Услуги';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Основное')->schema([
                Forms\Components\TextInput::make('title')->label('Название')->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', \Str::slug($state))),
                Forms\Components\TextInput::make('slug')->label('Slug')->required(),
                Forms\Components\Textarea::make('short_desc')->label('Краткое описание')->rows(3),
                Forms\Components\RichEditor::make('description')->label('Описание')->columnSpanFull(),
            ])->columns(2),

            Forms\Components\Section::make('Цена')->schema([
                Forms\Components\TextInput::make('price')->label('Цена')->numeric()->prefix('₽'),
                Forms\Components\Toggle::make('price_from')->label('От (цена от...)')->inline(false),
                Forms\Components\TextInput::make('price_note')->label('Примечание к цене'),
            ])->columns(3),

            Forms\Components\Section::make('Настройки')->schema([
                Forms\Components\TextInput::make('sort_order')->label('Порядок сортировки')->numeric()->default(0),
                Forms\Components\Toggle::make('is_active')->label('Активна')->inline(false)->default(true),
                Forms\Components\Toggle::make('is_featured')->label('Рекомендуемая')->inline(false),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Название')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('price')->label('Цена')->money('RUB')->sortable(),
                Tables\Columns\IconColumn::make('is_active')->label('Активна')->boolean(),
                Tables\Columns\IconColumn::make('is_featured')->label('Рекомендуемая')->boolean()->toggleable(),
                Tables\Columns\TextColumn::make('sort_order')->label('Порядок')->sortable(),
            ])
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit'   => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
