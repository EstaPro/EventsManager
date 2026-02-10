<?php

namespace App\Orchid\Screens\Interaction;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;

class ConversationListScreen extends Screen
{
    public $name = 'Conversations';
    public $description = 'Monitor chat activity between users.';

    public function query(): array
    {
        $subQuery = Message::select(
            DB::raw('CASE WHEN sender_id < receiver_id THEN sender_id ELSE receiver_id END as user_1'),
            DB::raw('CASE WHEN sender_id < receiver_id THEN receiver_id ELSE sender_id END as user_2'),
            DB::raw('MAX(created_at) as last_message_at'),
            DB::raw('COUNT(*) as total_messages')
        )
            ->groupBy('user_1', 'user_2')
            ->orderByDesc('last_message_at');

        $conversations = $subQuery->paginate(20);

        $userIds = $conversations->getCollection()
            ->flatMap(fn($c) => [$c->user_1, $c->user_2])
            ->unique();

        $users = User::whereIn('id', $userIds)->get()->keyBy('id');

        $conversations->getCollection()->transform(function ($c) use ($users) {
            $c->participant1 = $users[$c->user_1] ?? null;
            $c->participant2 = $users[$c->user_2] ?? null;
            return $c;
        });

        return ['conversations' => $conversations];
    }

    public function layout(): array
    {
        return [
            Layout::table('conversations', [

                TD::make('participant1', 'Participant A')
                    ->render(fn($c) =>
                        optional($c->participant1)->name . ' ' . optional($c->participant1)->last_name
                    ),

                TD::make('participant2', 'Participant B')
                    ->render(fn($c) =>
                        optional($c->participant2)->name . ' ' . optional($c->participant2)->last_name
                    ),

                TD::make('total_messages', 'Msgs')
                    ->sort()
                    ->align(TD::ALIGN_CENTER),

                TD::make('last_message_at', 'Last Activity')
                    ->render(fn($c) =>
                    \Carbon\Carbon::parse($c->last_message_at)->diffForHumans()
                    ),

                TD::make('Actions')
                    ->align(TD::ALIGN_CENTER)
                    ->render(fn($c) =>
                    Link::make('Open Chat')
                        ->icon('bs.chat-dots')
                        ->route('platform.conversations.view', [
                            'user1' => $c->user_1,
                            'user2' => $c->user_2,
                        ])
                    ),
            ])
        ];
    }
}
