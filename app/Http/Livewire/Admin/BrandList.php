<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSweetAlert;
use App\Models\Brand;

class BrandList extends Component
{
    use WithPagination;
    use WithSweetAlert;

    public $search;

    protected $listeners = [
        'onBrandCreated' => '$refresh',
        'onBrandUpdated' => '$refresh',
        'onBrandDelete' => 'deleteBrand',
    ];


    public function render()
    {
        $brands = $this->getBrands();

        return view('admin.components.brand-list', compact('brands'));
    }


    public function enableBrandEditMode($id)
    {
        $this->emit('onBrandEdit', $id);
    }


    public function confirmDeleteBrand($id)
    {
        return $this->ifConfirmThenDispatch('onBrandDelete', $id, 'Are you sure ?', 'Brand will delete permanently !');
    }


    public function deleteBrand($id)
    {
        if(Brand::destroy($id)){
            return $this->success('Success', 'Brand deleted successfully.');
        }

        return $this->error('Failed', 'Failed to delete Brand. try again');
    }


    private function getBrands()
    {

        $search = $this->search;

        $query = Brand::query();

        $query->when($this->search, function($query) use($search){
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('name', $search);
        });

        return $query->paginate(25);

    }
}
