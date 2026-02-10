<?php

namespace App\Orchid\Screens\Company;

use App\Models\Company;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Color;

class CompanyListScreen extends Screen
{
    public $name = 'Exhibitors';
    public $description = 'List of all participating companies.';

    public function query(): array
    {
        return [
            'companies' => Company::filters()->defaultSort('id', 'desc')->paginate(15)
        ];
    }

    public function commandBar(): array
    {
        return [
            Link::make('Add Exhibitor')
                ->icon('bs.plus-circle')
                ->type(Color::PRIMARY)
                ->route('platform.companies.create')
        ];
    }

    public function layout(): array
    {
        return [
            Layout::table('companies', [
                // Logo with visual check
                TD::make('logo', 'Logo')
                    ->width('80px')
                    ->render(fn($c) => $c->logo
                        ? "<img src='".asset($c->logo)."' width='50' style='border-radius:4px; object-fit:contain;'>"
                        : "<span class='text-muted'>No Logo</span>"),

                TD::make('name', 'Name')
                    ->sort()
                    ->filter(TD::FILTER_TEXT)
                    ->render(fn($c) => "<strong>{$c->name}</strong><br><small class='text-muted'>{$c->email}</small>"),

                TD::make('booth_number', 'Booth')
                    ->sort()
                    ->width('100px'),

                TD::make('category', 'Category')
                    ->sort()
                    ->render(fn($c) => $c->category ?? '-'),

                TD::make('country', 'Country')
                    ->sort()
                    ->render(fn($c) => $c->country ?? '-'),

                // Status Column (Active + Featured)
                TD::make('status', 'Status')
                    ->render(function ($c) {
                        $html = '';
                        if ($c->is_active) {
                            $html .= '<span class="badge bg-success me-1">Active</span>';
                        } else {
                            $html .= '<span class="badge bg-secondary me-1">Hidden</span>';
                        }

                        if ($c->is_featured) {
                            $html .= '<span class="badge bg-warning text-dark">⭐ Featured</span>';
                        }
                        return $html;
                    }),

                TD::make('Actions')
                    ->alignRight()
                    ->render(fn($c) => Link::make('Edit')
                        ->icon('bs.pencil')
                        ->class('btn btn-sm btn-link')
                        ->route('platform.companies.edit', $c->id)
                    )
            ])
        ];
    }
}
