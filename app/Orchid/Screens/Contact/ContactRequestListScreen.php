<?php

namespace App\Orchid\Screens\Contact;

use App\Models\ContactRequest;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Color;

class ContactRequestListScreen extends Screen
{
    public function name(): ?string { return 'Contact Inbox'; }

    public function description(): ?string { return 'Support messages and inquiries from the mobile app.'; }

    public function query(): iterable
    {
        return [
            'contacts' => ContactRequest::orderBy('created_at', 'desc')->paginate()
        ];
    }

    public function commandBar(): iterable { return []; }

    public function layout(): iterable
    {
        return [
            Layout::table('contacts', [
                TD::make('created_at', 'Date')
                    ->render(fn($c) => $c->created_at->format('M d, H:i'))
                    ->sort(),

                TD::make('name', 'Sender Info')
                    ->render(fn($c) => "<div><strong>{$c->name}</strong></div><div class='text-muted text-small'>{$c->email}</div>"),

                TD::make('subject', 'Subject')->sort(),

                TD::make('message', 'Message')
                    ->width('400px')
                    ->render(fn($c) => \Illuminate\Support\Str::limit($c->message, 100)),

                TD::make('is_handled', 'Status')->sort()->render(fn($c) =>
                $c->is_handled
                    ? '<span class="text-success">✔ Handled</span>'
                    : '<span class="text-danger">● New</span>'
                ),

                TD::make('Actions')->alignRight()->render(fn($c) =>
                Button::make('Mark as Handled')
                    ->method('markAsHandled', ['id' => $c->id])
                    ->icon('bs.check2-circle')
                    ->type(Color::SUCCESS)
                    ->canSee(!$c->is_handled)
                )
            ])
        ];
    }

    public function markAsHandled($id)
    {
        ContactRequest::where('id', $id)->update(['is_handled' => true]);
        Toast::info('Request marked as handled.');
    }
}
