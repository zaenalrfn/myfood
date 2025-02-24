<?php

namespace App\Livewire\Traits;

use Livewire\Attributes\On;
// untuk ngefilter makanan berdasarkan kategori
trait CategoryFilterTrait
{

    #[On('filterApplied')]
    // untuk mengfilter kategori yang sesuai
    public function applyFilter($selectedCategories)
    {
        $this->selectedCategories = $selectedCategories;
    }

    public function getFilteredItems()
    {
        if (count($this->selectedCategories) > 0) {
            return $this->items->filter(function ($item) {
                return in_array($item->categories_id, $this->selectedCategories);
            });
        }
        return $this->items;
    }
}
