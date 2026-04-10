<?php

namespace App\Filament\Resources;

use App\Domain\Orders\Models\Order;
use App\Filament\Resources\OrderResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationGroup = 'Продажи';
    protected static ?string $label = 'Заказ';
    protected static ?string $pluralLabel = 'Заказы';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Заказ')->schema([
                Forms\Components\TextInput::make('uuid')->label('UUID')->disabled(),
                Forms\Components\Select::make('user_id')->label('Пользователь')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('course_id')->label('Курс')
                    ->relationship('course', 'title')
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('status')->label('Статус')->options([
                    'pending'          => 'Ожидает',
                    'awaiting_payment' => 'Ожидает оплаты',
                    'paid'             => 'Оплачен',
                    'canceled'         => 'Отменён',
                    'refunded'         => 'Возврат',
                ])->required(),
            ])->columns(2),

            Forms\Components\Section::make('Оплата')->schema([
                Forms\Components\TextInput::make('amount')->label('Сумма')->numeric()->prefix('₽'),
                Forms\Components\TextInput::make('discount')->label('Скидка')->numeric()->prefix('₽'),
                Forms\Components\TextInput::make('promo_code')->label('Промокод'),
                Forms\Components\DateTimePicker::make('paid_at')->label('Дата оплаты'),
            ])->columns(2),

            Forms\Components\Section::make('Заметки')->schema([
                Forms\Components\Textarea::make('notes')->label('Заметки')->rows(3)->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('uuid')->label('UUID')
                    ->formatStateUsing(fn ($state) => substr($state, 0, 8))
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')->label('Пользователь')->searchable(),
                Tables\Columns\TextColumn::make('course.title')->label('Курс')->toggleable(),
                Tables\Columns\TextColumn::make('status')->label('Статус')->badge()->colors([
                    'success' => 'paid',
                    'warning' => 'pending',
                    'danger'  => 'canceled',
                    'gray'    => fn ($state) => in_array($state, ['awaiting_payment', 'refunded']),
                ]),
                Tables\Columns\TextColumn::make('amount')->label('Сумма')->money('RUB')->sortable(),
                Tables\Columns\TextColumn::make('paid_at')->label('Дата оплаты')->date('d.m.Y')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('Создан')->date('d.m.Y')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'edit'  => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
