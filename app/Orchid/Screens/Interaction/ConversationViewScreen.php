<?php

namespace App\Orchid\Screens\Interaction;

use App\Models\Message;
use App\Models\User;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class ConversationViewScreen extends Screen
{
    /**
     * @var User
     */
    public $user1;

    /**
     * @var User
     */
    public $user2;

    /**
     * Query data.
     *
     * IMPORTANT: The argument names ($user1, $user2) MUST match
     * the route parameters defined in your routes/platform.php
     * e.g., Route::screen('conversations/{user1}/{user2}', ...)
     */
    public function query(User $user1, User $user2): array
    {
        $this->user1 = $user1;
        $this->user2 = $user2;

        // Fetch messages between these two users
        $messages = Message::where(function ($q) use ($user1, $user2) {
            $q->where('sender_id', $user1->id)->where('receiver_id', $user2->id);
        })
            ->orWhere(function ($q) use ($user1, $user2) {
                $q->where('sender_id', $user2->id)->where('receiver_id', $user1->id);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return [
            'messages' => $messages,
            'user1'    => $user1,
            'user2'    => $user2,
        ];
    }

    public function name(): ?string
    {
        return 'Chat History';
    }

    public function description(): ?string
    {
        return "Conversation view";
    }

    public function commandBar(): array
    {
        return [];
    }

    public function layout(): array
    {
        return [
            // We point to a custom Blade view for the chat UI
            Layout::view('admin.conversation'),
        ];
    }
}
