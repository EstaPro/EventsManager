<?php

namespace App\Orchid\Screens\Interaction\Networking;

use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Label;

class NetworkingStatsLayout extends Rows
{
    protected function fields(): iterable
    {
        return [
            Label::make('stats.requests_today')
                ->title('📩 Requests Today'),

            Label::make('stats.pending_requests')
                ->title('⏳ Pending Requests'),

            Label::make('stats.active_chats')
                ->title('💬 Active Chats (24h)'),

            Label::make('stats.flagged_users')
                ->title('🚩 Flagged Users'),
        ];
    }
}
