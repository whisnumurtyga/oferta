<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryShow extends Component
{
    public $categoryId, $oldCategory;
    public $edit_name, $name;

    protected $listeners = [
        'deleteConfirmed' => 'deleteCategory'
    ];

    public function render()
    {
        return view('livewire.category-show', [
            'categories' => $this->getCategories()
        ]);
    }

    public function getCategories()
    {
        return Category::all();
    }

    // public function deleteConfirmation($categoryId)
    // {
    //     // dd($userId);
    //     $this->categoryId = $categoryId;
    //     $this->dispatchBrowserEvent('show-delete-confirmation');
    // }

    // public function deleteCategory()
    // {
    //     Category::find($this->categoryId)->delete();
    //     $this->getCategories();

    //     $this->dispatchBrowserEvent('category-deleted');
    // }
    public function addCategory()
    {
        Category::create([
            'name' => $this->name
        ]);

        $this->dispatchBrowserEvent('category-added');
    }

    public function editCategory($categoryId)
    {
        $this->oldCategory = Category::where('id', $categoryId)->first();
        $this->edit_name = $this->oldCategory->name;
    }

    public function updateCategory()
    {
        Category::where('id', $this->oldCategory->id)->update([
            'name' => $this->name
        ]);

        $this->edit_name = null;

        $this->dispatchBrowserEvent('category-updated');
        // $this->dispatchBrowserEvent('close-modal');
    }


}
