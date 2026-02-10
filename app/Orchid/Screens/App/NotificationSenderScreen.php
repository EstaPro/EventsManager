<?php

namespace App\Orchid\Screens\App;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;
use App\Models\Notification;
use App\Models\User;

class NotificationSenderScreen extends Screen
{
    public $name = 'Push Notifications';
    public $description = 'Send alerts to mobile app users.';

    public function query(): array
    {
        return [];
    }

    public function commandBar(): array
    {
        return [
            Button::make('Send Notification')
                ->icon('paper-plane')
                ->method('send')
                ->confirm('Are you sure you want to send this alert to ALL users?')
        ];
    }

    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('title')
                    ->title('Notification Title')
                    ->required()
                    ->placeholder('e.g. Keynote starting in 10 minutes!'),

                TextArea::make('body')
                    ->title('Message Body')
                    ->required()
                    ->rows(3),

                Select::make('type')
                    ->options([
                        'info' => 'General Info',
                        'alert' => 'Urgent Alert',
                        'promo' => 'Promotion',
                    ])
                    ->title('Type'),
            ])
        ];
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'type' => 'required'
        ]);

        // 1. Save to Database for History
        // In a real app, you would loop through users or use a Job
        // For now, we simulate saving a global notification

        // Example: Logic to send to FCM would go here

        Toast::success('Notification sent to queue!');
    }
}
