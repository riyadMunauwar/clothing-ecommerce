<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSweetAlert;
use App\Models\Category;

class CategoryList extends Component
{

    use WithPagination;
    use WithSweetAlert;

    public $search;

    protected $listeners = [
        'onCategoryCreated' => '$refresh',
        'onCategoryUpdated' => '$refresh',
        'onCategoryDelete' => 'deleteCategory',
    ];


    public function render()
    {
        $categories = $this->getCategories();

        return view('admin.components.category-list', compact('categories'));
    }


    public function enableCategoryEditMode($id)
    {
        $this->emit('onCategoryEdit', $id);
    }


    public function confirmDeleteCategory($id)
    {
        return $this->ifConfirmThenDispatch('onCategoryDelete', $id, 'Are you sure ?', 'Category will delete permanently !');
    }


    public function deleteCategory($id)
    {
        if(Category::destroy($id)){
            return $this->success('Success', 'Category deleted successfully.');
        }

        return $this->error('Failed', 'Failed to delete category. try again');
    }


    private function getCategories()
    {

        $search = $this->search;

        $query = Category::query();

        $query->when($this->search, function($query) use($search){
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('name', $search);
        });

        return $query->paginate(25);

    }
}
