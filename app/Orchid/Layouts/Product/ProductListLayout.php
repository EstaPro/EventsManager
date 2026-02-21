<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Product;

use App\Models\Product;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ProductListLayout extends Table
{
    /**
     * Data source.
     * Matches the key returned in the Screen's query() method.
     *
     * @var string
     */
    public $target = 'products';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('image', 'Preview')
                ->width('80px')
                ->render(fn (Product $product) => $product->image_url
                    ? "<img src='{$product->image_url}' alt='img' class='mw-100 d-block img-fluid rounded-1' style='height:40px; width:auto; object-fit:cover;'>"
                    : ''),

            TD::make('name', 'Name')
                ->sort()
                ->filter(Input::make())
                ->render(fn (Product $product) => Link::make($product->name)
                    ->route('platform.products.edit', $product->id)
                    ->class('fw-bold')),

            TD::make('category_id', 'Category')
                ->render(function (Product $product) {
                    return $product->category
                        ? Link::make($product->category->name)->route('platform.categories.edit', $product->category->id)
                        : '<span class="text-muted">—</span>';
                }),

            TD::make('company_id', 'Company')
                ->render(fn (Product $product) => $product->company->name ?? '—'),

            TD::make('type', 'Type')
                ->sort()
                ->filter(Input::make()),

            TD::make('is_featured', 'Featured')
                ->sort()
                ->render(fn (Product $product) => $product->is_featured
                    ? '<span class="text-success">● Yes</span>'
                    : '<span class="text-muted">○ No</span>'),

            TD::make('created_at', 'Created')
                ->sort()
                ->render(fn ($product) => $product->created_at->format('M d, Y')),
        ];
    }
}
