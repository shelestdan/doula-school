<?php

namespace App\Filament\Resources;

use App\Domain\Courses\Models\Course;
use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Обучение';
    protected static ?string $label = 'Курс';
    protected static ?string $pluralLabel = 'Курсы';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make()->tabs([
                Forms\Components\Tabs\Tab::make('Основное')->schema([
                    Forms\Components\TextInput::make('title')->label('Название')->required()->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', \Str::slug($state))),
                    Forms\Components\TextInput::make('slug')->label('Slug')->required(),
                    Forms\Components\Textarea::make('short_desc')->label('Краткое описание')->rows(2),
                    Forms\Components\RichEditor::make('description')->label('Описание')->columnSpanFull(),
                    Forms\Components\TextInput::make('cover')->label('Обложка (URL)'),
                    Forms\Components\TextInput::make('video_preview_url')->label('Превью-видео (URL)'),
                ])->columns(2),

                Forms\Components\Tabs\Tab::make('Цена и доступ')->schema([
                    Forms\Components\TextInput::make('price')->label('Цена')->numeric()->prefix('₽')->required(),
                    Forms\Components\TextInput::make('old_price')->label('Старая цена')->numeric()->prefix('₽'),
                    Forms\Components\Select::make('access_type')->label('Тип доступа')->options([
                        'lifetime' => 'Навсегда',
                        'limited'  => 'Ограниченный',
                    ])->default('lifetime'),
                    Forms\Components\TextInput::make('access_days')->label('Дней доступа')->numeric(),
                    Forms\Components\Select::make('level')->label('Уровень')->options([
                        'beginner'     => 'Начинающий',
                        'intermediate' => 'Средний',
                        'advanced'     => 'Продвинутый',
                    ]),
                    Forms\Components\TextInput::make('duration_hours')->label('Длительность (ч)')->numeric(),
                    Forms\Components\TextInput::make('lessons_count')->label('Кол-во уроков')->numeric(),
                    Forms\Components\TextInput::make('badge')->label('Бейдж (Хит / Новинка)'),
                ])->columns(2),

                Forms\Components\Tabs\Tab::make('Чему учит')->schema([
                    Forms\Components\TagsInput::make('what_you_learn')->label('Что узнаете')->columnSpanFull(),
                    Forms\Components\TagsInput::make('requirements')->label('Требования')->columnSpanFull(),
                    Forms\Components\TagsInput::make('includes')->label('Включает')->columnSpanFull(),
                ]),

                Forms\Components\Tabs\Tab::make('SEO')->schema([
                    Forms\Components\TextInput::make('meta_title')->label('Meta title'),
                    Forms\Components\Textarea::make('meta_description')->label('Meta description')->rows(2),
                    Forms\Components\TextInput::make('og_image')->label('OG Image URL'),
                ])->columns(1),
            ])->columnSpanFull(),

            Forms\Components\Section::make('Публикация')->schema([
                Forms\Components\Toggle::make('is_published')->label('Опубликован'),
                Forms\Components\Toggle::make('is_featured')->label('Рекомендуемый'),
                Forms\Components\TextInput::make('sort_order')->label('Порядок')->numeric()->default(0),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Название')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('price')->label('Цена')->money('RUB')->sortable(),
                Tables\Columns\IconColumn::make('is_published')->label('Опубл.')->boolean(),
                Tables\Columns\IconColumn::make('is_featured')->label('Хит')->boolean()->toggleable(),
                Tables\Columns\TextColumn::make('lessons_count')->label('Уроков')->sortable(),
                Tables\Columns\TextColumn::make('sort_order')->label('Порядок')->sortable()->toggleable(),
            ])
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getRelationManagers(): array
    {
        return [
            RelationManagers\ModulesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit'   => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
