<?php

namespace App\Filament\Widgets;

use App\Domain\Courses\Models\CourseAccessGrant;
use App\Domain\Leads\Models\Lead;
use App\Domain\Orders\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $navigationSort = 1;
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Новые заявки сегодня', Lead::whereDate('created_at', today())->count()),

            Stat::make(
                'Оплаченных заказов в этом месяце',
                Order::paid()->whereMonth('paid_at', now()->month)->count()
            ),

            Stat::make(
                'Выручка в этом месяце',
                '₽ ' . number_format(
                    Order::paid()->whereMonth('paid_at', now()->month)->sum('amount'),
                    0, '.', ' '
                )
            ),

            Stat::make(
                'Активных студентов',
                CourseAccessGrant::active()->distinct('user_id')->count('user_id')
            ),
        ];
    }
}
