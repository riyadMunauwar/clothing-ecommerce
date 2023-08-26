<?php

namespace App\Http\Livewire\Admin\Report;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class SalesReport extends Component
{

    use WithPagination;

    public $from_date;
    public $to_date;
    public $status;
    public $last_day; 

    public function render()
    {
        $sales = $this->getSalesReport();
        return view('admin.components.report.sales-report', ['sales' => $sales]);
    }

    public function getSalesReport()
    {
        $from_date = $this->from_date;
        $to_date = $this->to_date;
        $status = $this->status;
        $last_day = $this->last_day;

        return  Order::selectRaw('DATE(order_date) as date, COUNT(*) as total_order, SUM(total_product_price) as total_sale')
                        ->groupBy('date')
                        ->when($from_date && $to_date, function($query) use($from_date, $to_date){
                            $query->whereBetween('order_date', [$from_date, $to_date]);
                        })
                        ->when($status, function($query) use($status){
                            
                        })
                        ->when($last_day, function($query) use($last_day){
                            $query->whereDate('order_date', '>=', now()->subDays($last_day));
                        })
                        ->paginate(31);
    }
}
