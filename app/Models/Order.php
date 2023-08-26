<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaracraftTech\LaravelDateScopes\DateScopes;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;
    use DateScopes;


    protected $casts = [
        'order_date' => 'datetime',
        'paid_at' => 'datetime',
    ];



    public function totalPrice()
    {
        return $this->total_product_price + $this->shipping_cost + $this->total_vat;
    }

    public static function getCurrentMonthSales()
    {
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();

        $sales = static::selectRaw('DATE(order_date) as date, SUM(total_product_price) as total_sales')
            ->whereBetween('order_date', [$currentMonthStart, $currentMonthEnd])
            ->groupBy('date')
            ->get();

        $chartData = [];
        foreach ($sales as $sale) {
            $chartData[$sale->date] = $sale->total_sales;
        }

        return $chartData;
    }


    public static function getCurrentMonthOrders()
    {
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();

        $orders = static::selectRaw('DATE(order_date) as date, COUNT(*) as total_orders')
            ->whereBetween('order_date', [$currentMonthStart, $currentMonthEnd])
            ->groupBy('date')
            ->get();

        $chartData = [];
        foreach ($orders as $order) {
            $chartData[$order->date] = $order->total_orders;
        }

        return $chartData;
    }

    // Relation

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }


    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function admin()
    {
       return $this->belongsTo(User::class);
    }
}
