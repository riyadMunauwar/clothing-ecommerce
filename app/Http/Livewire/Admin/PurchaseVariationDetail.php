<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Variation;

class PurchaseVariationDetail extends Component
{

    public $is_purchase_variation_modal_show = false;
    public $variation;

    protected $listeners = [
        'onShowPurchaseVariation' => 'showPurchaseVariation',
    ];

    public function render()
    {
        return view('admin.components.purchase-variation-detail');
    }

    public function showPurchaseVariation($variationId)
    {
        $this->variation = Variation::find($variationId);
        $this->is_purchase_variation_modal_show = true;
    }

    public function cancelPurchaseVariation()
    {
        $this->reset();
    }
}
