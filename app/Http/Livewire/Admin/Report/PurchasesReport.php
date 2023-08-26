<?php

namespace App\Http\Livewire\Admin\Report;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Pagination\Paginator;

class PurchasesReport extends Component
{
    use WithPagination;

    public $suppliers = [];
   
    public $filter_by;
    public $search;
    public $supplier_id;

    public $is_show_supplier_details = false;

    public $selectedSupplier;


    protected $listeners = [
        'onPurchaseUpdated' => '$refresh'
    ];

    public function mount()
    {
        $this->suppliers = Supplier::all();
    }


    public function render()
    {
        $allSuppliersPurchases = $this->allSuppliersPurchases();
        $singleSupplierPurchases = $this->getSingleSupplierPurchaseDetail($this->supplier_id);

        return view('admin.components.report.purchases-report', compact('allSuppliersPurchases', 'singleSupplierPurchases'));
    }

    public function updatedSupplierId($supplierId)
    {
        $this->selectedSupplier = Supplier::find($supplierId);
    }


    public function enablePurchaseEditMode($id)
    {
        return $this->emit('onUpdatePurchaseModalShow', $id);
    }


    public function showPurchaseVariationDetail($variationId)
    {
        return $this->emit('onShowPurchaseVariation', $variationId);
    }


    private function getSingleSupplierPurchaseDetail($supplierId)
    {

        $onlyPaid = $this->filter_by === 'paid' ? true : false;
        $onlyUnpaid = $this->filter_by === 'unpaid' ? true : false;
        $partiallyPaid = $this->filter_by === 'partially-paid' ? true : false;

        $search_terms = trim($this->search);
        
        $purchases = Purchase::selectRaw('purchases.id, purchases.variation_id, purchases.supplier_id, products.name as product_name, purchases.price as unit_price, purchases.qty as qty, (purchases.price * purchases.qty) as bill_amount,  purchases.paid_to_supplier as paid_amount, (purchases.price * purchases.qty) - purchases.paid_to_supplier as due_amount, purchases.created_at')
                            ->join('products', 'products.id', '=', 'purchases.product_id')
                            ->where('supplier_id', $supplierId)
                            ->when($onlyUnpaid, function($query){
                                $query->whereNull('purchases.paid_to_supplier');
                            })
                            ->when($onlyPaid, function($query){
                                $query->whereRaw('purchases.price * purchases.qty = purchases.paid_to_supplier');
                            })
                            ->when($onlyUnpaid, function($query){
                                $query->whereRaw('purchases.price * purchases.qty > purchases.paid_to_supplier');
                            })
                            ->when($search_terms, function($query) use($search_terms){
                                $query->where('products.name', $search_terms)
                                      ->orWhere('products.name', 'like', '%' . $search_terms . '%');
                            })
                            // ->orderBy('purchases.updated_at', 'desc')
                            ->latest()
                            ->paginate(100);
        return $purchases;
    }

    private function allSuppliersPurchases()
    {
        $purchases = Purchase::selectRaw('products.name as product_name, suppliers.name as supplier_name, purchases.price as unit_price, purchases.qty as qty, (purchases.price * purchases.qty) as bill_amount,  purchases.paid_to_supplier as paid_amount, (purchases.price * purchases.qty) - purchases.paid_to_supplier as due_amount')
                             ->join('suppliers', 'suppliers.id', '=', 'purchases.supplier_id')
                             ->join('products', 'products.id', '=', 'purchases.product_id')
                             ->get()->groupBy('supplier_name');

        $purchasesDetails = [];

        foreach($purchases as $supplier => $purchasesFromSupplier){
            $eachSupplierDetails = [
                'supplier_name' => $supplier,
                'total_items_quantity' => $purchasesFromSupplier->sum('qty'),
                'total_bill_amount' => $purchasesFromSupplier->sum('bill_amount'),
                'total_bill_paid' => $purchasesFromSupplier->sum('paid_amount'),
                'total_bill_due' => $purchasesFromSupplier->sum('due_amount'),
            ];

            $purchasesDetails[] = $eachSupplierDetails;
        }
        
        return $purchasesDetails;
    }
}
