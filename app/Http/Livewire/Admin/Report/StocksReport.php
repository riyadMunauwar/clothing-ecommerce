<?php

namespace App\Http\Livewire\Admin\Report;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class StocksReport extends Component
{

    use WithPagination;

    public $quantity_abobe;
    public $quantity_below;
    public $stock_availability;

    public function render()
    {
        $products = $this->getProducts();
        return view('admin.components.report.stocks-report', compact('products'));
    }


    private function getProducts()
    {
        $query = Product::withCount('variations');


        return $query->paginate(50);
    }
}
