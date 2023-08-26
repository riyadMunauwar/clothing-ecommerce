<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSweetAlert;
use App\Models\Product;

class ProductList extends Component
{

    use WithPagination;
    use WithSweetAlert;

    public $search;

    protected $listeners = [
        'onProductCreated' => '$refresh',
        'onProductUpdated' => '$refresh',
        'onAddStock' => '$refresh',
        'onVariationDeleted' => '$refresh',
        'onProductDelete' => 'deleteProduct',
    ];


    public function render()
    {
        $products = $this->getProducts();
        return view('admin.components.product-list', compact('products'));
    }

    public function enableProductEditMode($id)
    {
        $this->emit('onProductEdit', $id);
    }


    public function showVariationList($id)
    {
        $this->emit('onVariatioShow', $id);
    }


    public function enableAddStockModal($productId, $varationId = null)
    {
        $this->emit('onAddStockModalShow', $productId);
    }


    public function confirmDeleteProduct($id)
    {
        return $this->ifConfirmThenDispatch('onProductDelete', $id, 'Are you sure ?', 'Product will delete permanently !');
    }


    public function deleteProduct($id)
    {
        try {

            $product = Product::with('variations')->find($id);

            $product->categories()->detach();

            foreach($product->variations as $variant)
            {
                $variant->delete();
            }

            if($product->delete()){
                return $this->success('Success', 'Product deleted successfully.');
            }

        }catch(\Exception $e)
        {
            return $this->error('Failed', $e->getMessage());
        }

    }


    private function getProducts()
    {

        $search = $this->search;

        $query = Product::query();

        $query->when($this->search, function($query) use($search){
            $query->where('name', 'like', '%' . $search . '%');
        });

        return $query->with('categories', 'brand')->withCount('variations')->paginate(25);

    }
}
