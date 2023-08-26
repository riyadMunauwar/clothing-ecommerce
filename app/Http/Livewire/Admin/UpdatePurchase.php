<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Variation;
use Illuminate\Support\Facades\DB;
use App\Traits\WithSweetAlert;

class UpdatePurchase extends Component
{
    use WithSweetAlert;

    public $is_purchase_edit_mode_on = false;


    public $product_name;
    public $price;
    public $qty;
    public $product_id;
    public $variation_id;
    public $supplier_id;
    public $purchase_id;
    public $paid_to_supplier;

    public $purchase_item_qty_before_update;

    public $suppliers = [];


    public function getTotalPurchasePriceProperty()
    {
        if($this->price && $this->qty){
            return $this->price * $this->qty;
        }

        if($this->price) {
            return $this->price;
        }

        return 0;
    }


    protected $rules = [
        'price' => ['required', 'numeric'],
        'qty' => ['required', 'integer'],
        'supplier_id' => ['nullable'],
        'product_id' => ['required'],
        'paid_to_supplier' => ['nullable', 'numeric'],
    ];


    protected $listeners = [
        'onUpdatePurchaseModalShow' => 'showUpdatePurchaseModal',
    ];


    public function render()
    {
        return view('admin.components.update-purchase');
    }


    public function updatePurchase()
    {

        $this->validate();

     

        $success = DB::transaction(function(){
            
                        $changeStatus = $this->adjustStock();

                        if($changeStatus['change_status'] === 'increase'){
                            if($this->variation_id){
                                Variation::find($this->variation_id)->increment('stock_qty', $changeStatus['increase_qty']);
                            }else {
                                Product::find($this->product_id)->increment('stock_qty', $changeStatus['increase_qty']);
                            }
                        }

                        if($changeStatus['change_status'] === 'decrease'){
                            if($this->variation_id){
                                Variation::find($this->variation_id)->decrement('stock_qty', $changeStatus['decrease_qty']);
                            }else {
                                Product::find($this->product_id)->decrement('stock_qty', $changeStatus['decrease_qty']);
                            }
                        }

                        Purchase::where('id', $this->purchase_id)->update([
                            'price' => $this->price,
                            'qty' => $this->qty,
                            'supplier_id' => $this->supplier_id,
                            'paid_to_supplier' => $this->paid_to_supplier,
                        ]);

                        return true;
                    });

        
        if($success){
            $this->reset();
            $this->is_purchase_edit_mode_on = false;
            $this->emit('onPurchaseUpdated');
            return $this->success('Sucess', 'Purchase Updated successfully');
        }

        return $this->error('Failed', 'Purchase updated failed');

    }


    public function showUpdatePurchaseModal($id)
    {
        $this->preapredInitState();
        
        $purchase = Purchase::with('product')->find($id);

        $this->purchase_id = $purchase->id;
        $this->product_name = $purchase->product->name;
        $this->product_id = $purchase->product->id;
        $this->price = $purchase->price;
        $this->qty = $purchase->qty;
        $this->purchase_item_qty_before_update = $this->qty;
        $this->supplier_id = $purchase->supplier_id;
        $this->variation_id = $purchase->variation_id;
        $this->paid_to_supplier = $purchase->paid_to_supplier;


        $this->is_purchase_edit_mode_on = true;
    }

    public function cancelUpdatePurchase()
    {
        $this->reset();
        $this->is_purchase_edit_mode_on = false; 
    }


    private function adjustStock()
    {
        $change_status = '';

        $increase_qty = 0;
        $decrease_qty = 0;


        if($this->purchase_item_qty_before_update > $this->qty){

            $change_status = 'decrease';
            $decrease_qty = $this->purchase_item_qty_before_update - $this->qty;

        }elseif($this->purchase_item_qty_before_update === $this->qty)  {

            $change_status = 'no-change';

        }elseif($this->purchase_item_qty_before_update < $this->qty)  {

            $change_status = 'increase';
            $increase_qty = $this->qty - $this->purchase_item_qty_before_update;

        }

        return compact('change_status', 'increase_qty', 'decrease_qty');
    }

    private function preapredInitState()
    {
        $this->suppliers = Supplier::all();
    }

}
