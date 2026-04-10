<?php

namespace App\Filament\Resources;

use App\Domain\News\Models\News;
use App\Filament\Resources\NewsResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Контент';
    protected static ?string $label = 'Новость';
    protected static ?string $pluralLabel = 'Новости';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make()->tabs([
                Forms\Components\Tabs\Tab::make('Основное')->schema([
                    Forms\Components\TextInput::make('title')->label('Заголовок')->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', \Str::slug($state))),
                    Forms\Components\TextInput::make('slug')->label('Slug')->required(),
                    Forms\Components\Textarea::make('excerpt')->label('Анонс')->rows(3),
                    Forms\Components\RichEditor::make('content')->label('Содержание')->columnSpanFull(),
                    Forms\Components\TextInput::make('cover')->label('Обложка (URL)'),
                    Forms\Components\TextInput::make('author')->label('Автор'),
                    Forms\Components\TextInput::make('category')->label('Категория'),
                    Forms\Components\Select::make('status')->label('Статус')->options([
                        'draft'     => 'Черновик',
                        'published' => 'Опубликована',
                        'archived'  => 'Архив',
                    ])->required()->default('draft'),
                    Forms\Components\DateTimePicker::make('publish_at')->label('Дата публикации'),
                    Forms\Components\TagsInput::make('tags')->label('Теги'),
                ])->columns(2),

                Forms\Components\Tabs\Tab::make('SEO')->schema([
                    Forms\Components\TextInput::make('meta_title')->label('Meta title'),
                    Forms\Components\Textarea::make('meta_description')->label('Meta description')->rows(3),
                ])->columns(1),
            ])->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Заголовок')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('status')->label('Статус')->badge()->colors([
                    'warning' => 'draft',
                    'success' => 'published',
                    'gray'    => 'archived',
                ]),
                Tables\Columns\TextColumn::make('category')->label('Категория')->toggleable(),
                Tables\Columns\TextColumn::make('publish_at')->label('Дата публикации')->date('d.m.Y')->sortable(),
                Tables\Columns\TextColumn::make('views')->label('Просмотры')->sortable()->toggleable(),
            ])
            ->defaultSort('publish_at', 'desc')
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit'   => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
