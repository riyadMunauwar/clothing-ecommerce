<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;

class DashboardReportBox extends Component
{

    public $totalSales = 0;
    public $totalOrders = 0;
    public $totalProducts = 0;
    public $totalCustomers = 0;

    public $todayTotalSales = 0;
    public $todayTotalOrders = 0;
    public $todayTotalProducts = 0;
    public $totadyTotalCustomers = 0;

    public function mount()
    {
        $this->totalSales = $this->getTotalSales();
        $this->totalOrders = $this->getTotalOrdersCount();
        $this->totalProducts = $this->getTotalProductsCount();
        $this->totalCustomers = $this->getTotalCustomersCount();

        $this->todayTotalSales = $this->getTodayTotalSales();
        $this->todayTotalOrders = $this->getTodayTotalOrdersCount();
        $this->todayTotalProducts = $this->getTodayTotalProductsCount();
        $this->todayTotalCustomers = $this->getTodayTotalCustomersCount();
    }

    public function render()
    {
        return view('admin.components.dashboard-report-box');
    }



    public function getTotalSales()
    {
        return Order::whereNotNull('paid_at')->sum('total_product_price');
    }

    public function getTotalOrdersCount()
    {
        return Order::count();
    }

    public function getTotalProductsCount()
    {
        return Product::count();
    }

    public function getTotalCustomersCount()
    {
        return User::count();
    }

    public function getTodayTotalSales()
    {
        return Order::ofToday()->whereNotNull('paid_at')->sum('total_product_price');
    }

    public function getTodayTotalOrdersCount()
    {
        return Order::ofToday()->count();
    }

    public function getTodayTotalProductsCount()
    {
        return Product::ofToday()->count();
    }

    public function getTodayTotalCustomersCount()
    {
        return Product::ofToday()->count();
    }
}
