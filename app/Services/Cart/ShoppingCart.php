<?php 

namespace App\Actions\Admin;

use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;

class ShoppingCart {


    public function add($productId, $variantId = null, $qty)
    {

        if($qty <= 0) return $this->error('Minimum quantity is 1');

        // $product = Product::find($productId);

        // if(!$this->isStockAvailable($product, $qty)) return $this->error('Your selected quantity is greater than stock quantity');

        $item = $this->isAlreadyInTheCart($productId);

        if($item){

            $item = Cart::update($item->rowId, $qty);
            return $this->success('hello');

        }else {

            Cart::add([
                'id' => $productId,
                'name' => 'Product Name',
                'price' => 1562,
                'qty' => $qty,
                'weight' => 125,
                'options' => [
                    'thumbnail' => '',
                    'discountRate' => 10,
                    'discountType' => 'fixed',
                    'vatRate' => 10,
                    'vatType' => 'percentage',
                    'width' => 10,
                    'height' => 10,
                    'length' => 10,
                    'dimension_unit' => 'cm',
                    'weight_unit' => 'g',
                ]
            ]);

        }

    }



    public function remove($rowId)
    {
       return Cart::remove($rowId);
    }



    public function destroyAll()
    {
        return Cart::destroy();
    }



    public function update($rowId, $updateOption)
    {
        if(!Cart::get($rowId)){
            return $this->error('Invalid product');
        }

        return Cart::update($rowId, $updateOption);
    }



    public function increment($rowId, $qty)
    {

        $item = Cart::get($rowId);

        if(!$item){
            return $this->error('Invalid action');
        }

        $product = Product::find($productId);

        if(!$product) return $this->error('Invalid product id');

        $nextQty = $item->qty + (int) $qty;

        if(!$this->isStockAvailable($product, $nextQty)) return $this->error('Your selected quantity is greater than stock quantity');

        return Cart::update($rowId, $nextQty);

    }



    public function decrement($rowId, $qty)
    {
        $item = Cart::get($rowId);

        if(!$item){
            return $this->error('Invalid action');
        }

        $nextQty = $item->qty - (int) $qty;

        if($nextQty <= 0){
            return $this->error('Minimum order quantity 1');
        }

        return Cart::update($rowId, $nextQty);
    }



    public function all()
    {
        return Cart::content();
    }



    public function totalItems()
    {
        return Cart::count();
    }



    public function totalWeight()
    {
        return Cart::content()->sum('weight');
    }


    public function totalDimension()
    {
        return Cart::content()->reduce(function($carry, $item){
            return $carry + (($item->options->height * $item->options->length * $item->options->width) * $item->qty);
        }, 0);
    }


    public function totalVat()
    {
        return Cart::content()->reduce(function($carry, $item){

            return $carry + $this->calculateVat($item->price, $item->qty, $item->options->vatType, $item->options->vatRate);

        }, 0);
    }


    public function totalDiscount()
    {
        return Cart::content()->reduce(function($carry, $item){

            return $carry + $this->calculateDiscount($item->price, $item->qty, $item->options->discountType, $item->options->discountRate);

        }, 0);
    }


    public function subTotal()
    {
        return Cart::subtotal();
    }

    public function totalSubtotalPrice()
    {
        return Cart::content()->reduce(function($carry, $item){
            return $carry + ($item->price * $item->qty);
        }, 0);
    }


    private function calculateDiscount($itemPrice, $qty, $discountType, $discountRate)
    {
        if($discountType === 'fixed'){
            return $discountRate * $qty;
        }

        if($discountType === 'percentage'){
            return (($itemPrice * $discountRate) / 100) * $qty;
        }

    }


    private function calculateVat($itemPrice, $qty, $vatType, $vatRate)
    {
        if($vatType === 'fixed'){
            return $vatRate * $qty;
        }

        if($vatType === 'percentage'){
            return (($itemPrice * $vatRate) / 100) * $qty;
        }

    }


    private function isAlreadyInTheCart($productId)
    {
        return Cart::content()->firstWhere('id', $productId);
    }


    private function isStockAvailable($productId, $qty)
    {
        if($product->stock_qty >= $qty) return true;
        else return false;
    }


    private function success($message = '')
    {
        return [
            'isError' => false,
            'message' => $message,
        ];
    }


    public function error($message = '')
    {
        return [
            'isError' => true,
            'message' => $message,
        ];
    }
}