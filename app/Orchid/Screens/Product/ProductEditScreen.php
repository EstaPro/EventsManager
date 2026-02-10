<?php

namespace App\Orchid\Screens\Product;

use App\Models\Product;
use App\Models\Company;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ProductEditScreen extends Screen
{
    public $product;

    public function query(Product $product): iterable
    {
        return [
            'product' => $product
        ];
    }

    public function name(): ?string
    {
        return $this->product->exists ? 'Edit Product' : 'Create Product';
    }

    public function description(): ?string
    {
        return $this->product->exists
            ? 'Update product details and settings'
            : 'Add a new product to the catalog';
    }

    public function commandBar(): iterable
    {
        return [
            Link::make('Back to Products')
                ->icon('bs.arrow-left')
                ->class('btn btn-link')
                ->href(route('platform.products.list')),

            Button::make('Save')
                ->icon('bs.check-circle')
                ->method('save')
                ->class('btn btn-success'),

            Button::make('Remove')
                ->icon('bs.trash3')
                ->method('remove')
                ->confirm('Are you sure you want to delete this product?')
                ->canSee($this->product->exists)
                ->class('btn btn-danger'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::rows([
                // 1. Link to Company (Critical for Exhibitors)
                Relation::make('product.company_id')
                    ->title('Company')
                    ->required()
                    ->help('Which company does this product belong to?')
                    ->fromModel(Company::class, 'name')
                    ->placeholder('Select a company'),

                // 2. Basic Info
                Input::make('product.name')
                    ->title('Product Name')
                    ->required()
                    ->placeholder('Enter product name')
                    ->help('The display name for this product'),

                // 3. Category Selection
                Select::make('product.category_id')
                    ->title('Category')
                    ->help('Select a category for this product')
                    ->options(ProductCategory::pluck('name', 'id'))
                    ->empty('No category', ''),

                // 4. Product Type
                Input::make('product.type')
                    ->title('Product Type')
                    ->placeholder('e.g., Chemicals, Machines, Equipment')
                    ->help('Specify the type of product (optional)'),

                // 5. Product Image
                Cropper::make('product.image')
                    ->title('Product Image')
                    ->targetRelativeUrl()
                    ->width(800)
                    ->height(600)
                    ->help('Recommended size: 800x600px'),

                // 6. Description
                TextArea::make('product.description')
                    ->title('Description')
                    ->rows(6)
                    ->placeholder('Enter detailed product description')
                    ->help('Provide a comprehensive description of the product'),

                // 7. Featured Toggle
                CheckBox::make('product.is_featured')
                    ->title('Featured Product')
                    ->placeholder('Mark this product as featured')
                    ->help('Featured products will be highlighted in listings')
                    ->sendTrueOrFalse(),
            ])
        ];
    }

    public function save(Product $product, Request $request)
    {
        $request->validate([
            'product.company_id' => 'required|exists:companies,id',
            'product.name'       => 'required|max:255',
            'product.category_id' => 'nullable|exists:product_categories,id',
            'product.type'       => 'nullable|max:100',
            'product.description' => 'nullable',
            'product.is_featured' => 'boolean',
        ]);

        $productData = $request->get('product');

        // Ensure is_featured is a boolean
        $productData['is_featured'] = isset($productData['is_featured']) && $productData['is_featured'] ? true : false;

        // Handle category_id - convert empty string to null
        if (isset($productData['category_id']) && $productData['category_id'] === '') {
            $productData['category_id'] = null;
        }

        $product->fill($productData)->save();

        Toast::success('Product saved successfully.');
        return redirect()->route('platform.products.list');
    }

    public function remove(Product $product)
    {
        $product->delete();
        Toast::success('Product deleted successfully.');
        return redirect()->route('platform.products.list');
    }
}
