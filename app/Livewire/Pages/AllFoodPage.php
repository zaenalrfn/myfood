<?php

namespace App\Livewire\Pages;

use App\Livewire\Traits\CategoryFilterTrait;
use App\Models\Category;
use App\Models\Foods;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AllFoodPage extends Component
{
    use CategoryFilterTrait;

    public $categories;
    public $selectedCategories = [];
    public $items;
    public $title = "All Foods";

    public function mount(Foods $foods)
    {
        $this->categories = Category::all();
        // filter sesuai dengan yang dipilih user
        $this->items = $foods->getAllFoods();
    }

    #[Layout('components.layouts.page')]
    public function render()
    {
        $filteredProducts = $this->getFilteredItems();

        return view('product.all-food', [
            'filteredProducts' => $filteredProducts,
        ]);
    }
}
