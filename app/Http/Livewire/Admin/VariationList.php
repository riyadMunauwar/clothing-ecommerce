<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSweetAlert;
use App\Models\Variation;
use App\Models\Product;

class VariationList extends Component
{
    use WithPagination;
    use WithSweetAlert;

    public $search;
    public $product_name;
    public $product_id;
    public $variations = [];
    public $is_variations_show = false;

    protected $listeners = [
        'onVariatioShow' => 'enableVariationsShow',
        'onVariationDelete' => 'deleteVariation',
        'onVariationDeleted' => '$refresh',
        'onAddStock' => '$refresh',
        'onCancelVariationShow' => 'cancelVariationsShowMode',
    ];


    public function render()
    {
        return view('admin.components.variation-list');
    }


    public function enableVariationsShow($product_id)
    {
        $this->variations = Variation::where('product_id', $product_id)->get();
        $this->product_name = Product::select('name')->find($product_id)->name;
        $this->product_id = $product_id;
        $this->is_variations_show = true;
    }


    public function enableVariationEditMode($id)
    {
        $this->emit('onCancelVariationShow');
        $this->emit('onVariationEdit', $id);
    }

    public function confirmDeleteVariation($id)
    {
        return $this->ifConfirmThenDispatch('onVariationDelete', $id, 'Are you sure ?', 'Variation will delete permanently !');
    }

    
    public function enableAddStockModal($productId, $variationId = null)
    {
        $this->emit('onAddStockModalShow', $productId, $variationId);
    }

    public function cancelVariationsShowMode()
    {
        $this->reset();
    }

    public function deleteVariation($id)
    {

        if(Variation::destroy($id)){
            $this->emit('onVariationDeleted');
            return $this->success('Success', 'Variation deleted successfully.');
        }

        return $this->error('Failed', 'Failed to delete Variation. try again');
    }

}
