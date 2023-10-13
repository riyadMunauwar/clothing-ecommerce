<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaracraftTech\LaravelDateScopes\DateScopes;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\Payment;
use App\Models\Address;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;
    use DateScopes;


    protected $fillable = [
        'order_no',
        'total_price',
        'shipping_price',
        'admin_notes',
        'customer_notes',
        'user_id',
        'admin_id',
        'address_id',
        'shipping_option',
        'payment_option',
        'order_status',
        'payment_status',
    ];


    public function totalPrice()
    {
        return $this->total_price + $this->shipping_cost;
    }

    public static function getCurrentMonthSales()
    {
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();

        $sales = static::selectRaw('DATE(created_at) as date, SUM(total_price) as total_sales')
            ->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
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

        $orders = static::selectRaw('DATE(created_at) as date, COUNT(*) as total_orders')
            ->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
            ->groupBy('date')
            ->get();

        $chartData = [];

        foreach ($orders as $order) {
            $chartData[$order->date] = $order->total_orders;
        }

        return $chartData;
    }

    // Relation

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function address()
    {
       return $this->belongsTo(Address::class);
    }

    public function admin()
    {
       return $this->belongsTo(User::class);
    }
}
