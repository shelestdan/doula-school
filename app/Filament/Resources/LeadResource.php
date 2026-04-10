<?php

namespace App\Filament\Resources;

use App\Domain\Leads\Models\Lead;
use App\Filament\Resources\LeadResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'CRM';
    protected static ?string $label = 'Заявка';
    protected static ?string $pluralLabel = 'Заявки';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Контакт')->schema([
                Forms\Components\TextInput::make('name')->label('Имя')->required(),
                Forms\Components\TextInput::make('phone')->label('Телефон'),
                Forms\Components\TextInput::make('email')->label('Email')->email(),
                Forms\Components\TextInput::make('city')->label('Город'),
            ])->columns(2),

            Forms\Components\Section::make('Заявка')->schema([
                Forms\Components\Textarea::make('message')->label('Сообщение')->rows(3),
                Forms\Components\TextInput::make('source')->label('Источник'),
                Forms\Components\Select::make('status')->label('Статус')->options([
                    'new'        => 'Новая',
                    'in_work'    => 'В работе',
                    'qualified'  => 'Квалифицирована',
                    'converted'  => 'Конвертирована',
                    'lost'       => 'Потеряна',
                ])->required(),
                Forms\Components\Select::make('assigned_to')->label('Ответственный')
                    ->relationship('assignee', 'name'),
                Forms\Components\TagsInput::make('tags')->label('Теги'),
                Forms\Components\Textarea::make('notes')->label('Заметки')->rows(3),
            ])->columns(2),

            Forms\Components\Section::make('UTM')->schema([
                Forms\Components\TextInput::make('utm_source'),
                Forms\Components\TextInput::make('utm_medium'),
                Forms\Components\TextInput::make('utm_campaign'),
                Forms\Components\TextInput::make('utm_content'),
                Forms\Components\TextInput::make('utm_term'),
            ])->columns(2)->collapsed(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Имя')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('phone')->label('Телефон')->searchable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('source')->label('Источник')->badge()->toggleable(),
                Tables\Columns\BadgeColumn::make('status')->label('Статус')->colors([
                    'warning' => 'new',
                    'primary' => 'in_work',
                    'success' => fn ($state) => in_array($state, ['qualified', 'converted']),
                    'danger'  => 'lost',
                ]),
                Tables\Columns\TextColumn::make('assignee.name')->label('Ответственный')->toggleable(),
                Tables\Columns\TextColumn::make('created_at')->label('Дата')->dateTime('d.m.Y H:i')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->label('Статус')->options([
                    'new' => 'Новая', 'in_work' => 'В работе', 'converted' => 'Конвертирована', 'lost' => 'Потеряна',
                ]),
                Tables\Filters\SelectFilter::make('source')->label('Источник')->relationship('', 'source'),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\ViewAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListLeads::route('/'),
            'create' => Pages\CreateLead::route('/create'),
            'edit'   => Pages\EditLead::route('/{record}/edit'),
        ];
    }
}
