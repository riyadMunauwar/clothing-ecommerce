<?php 

namespace App\Services\Cart;


use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;
use App\Models\Variation;

class CartService {


    public function add($productId, $variantId = null, $qty)
    {
        // Check Valid Product
        $product = $this->checkIsValidProduct($productId);

        $variation = Variation::find($variantId);

        if(!$product){
            return $this->error('Invalid Action');
        }

        // Check Valid Qty
        if(!$this->checkIsValidQty($qty)){
            return $this->error('You can not select less then 1');
        }

        // Check stock Availability
        if($variation){
            if(!$this->checkIsStockAvailable($variation->stock_qty, $qty)) return $this->error('Your desired quantity is not available for this product');
        }else {
            if(!$this->checkIsStockAvailable($product->stock_qty, $qty)) return $this->error('Your desired quantity is not available for this product');
        }

        // Check is already in the cart
        $item = $this->checkIsAlreadyInCart($product->id);

        if($item){

            $item = Cart::update($item->rowId, $qty);

            return $this->success('Success fully added to the cart');

        }else {

            $salePrice = $product->sale_price;
            $thumbnail = $product->thumbnailUrl('thumb');
            $weight = $product->weight ?? 0;
            $height = $product->height ?? 0;
            $width = $product->width ?? 0;
            $length = $product->length ?? 0;
            $variationId = null;

            if($variation){
                $salePrice = $variation->sale_price;
                $thumbnail = $variation->thumbnailUrl('thumb');
                $weight = $variation->weight ?? 0;
                $height = $variation->height ?? 0;
                $width = $variation->width ?? 0;
                $length = $variation->length ?? 0;
                $variationId = $variation->id;
            }

            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'price' => $salePrice,
                'qty' => $qty,
                'weight' => $weight,
                'options' => [
                    'variation_id' => $variationId,
                    'thumbnail' => $thumbnail,
                    'width' => $width,
                    'height' => $height,
                    'length' => $length,
                ]
            ]);

            return $this->success('Success fully added to the cart');

        }
    }


    public function remove($rowId)
    {
        return Cart::remove($rowId);
    }


    public function removeAll()
    {
        return Cart::destroy();
    }


    public function increment($rowId, $updatedQty)
    {
        $item = Cart::get($rowId);

        if(!$item){
            return $this->error('Invalid action');
        }

        $product = Product::find($item->id);

        $variation = Product::find($item->options->variation_id);

        if(!$product) return $this->error('Invalid product id');

        $nextQty = $item->qty + (int) $updatedQty;

        if($variation){
            if(!$this->checkIsStockAvailable($variation->stock_qty, $nextQty)) return $this->error('Your selected quantity is greater than stock quantity');
        }else {
            if(!$this->checkIsStockAvailable($product->stock_qty, $nextQty)) return $this->error('Your selected quantity is greater than stock quantity');
        }
        
        Cart::update($rowId, $nextQty);

        return $this->success('Updated');
    }


    public function decrement($rowId, $updatedQty)
    {
        $item = Cart::get($rowId);

        if(!$item){
            return $this->error('Invalid action');
        }

        $nextQty = $item->qty - (int) $updatedQty;

        if($nextQty <= 0){
            return $this->error('You can not select less then 1');
        }

        Cart::update($rowId, $nextQty);

        return $this->success('Updated');
    }


    public function total($discount = 0, $shippingCost)
    {
        return ( $this->subTotal() + $shippingCost ) - $discount; 
    }


    public function subTotal()
    {
        return Cart::content()->reduce(function($carry, $item){
            return $carry + ($item->price * $item->qty);
        }, 0);
    }


    public function itemsCount()
    {
        return Cart::count();
    }


    public function all()
    {
        return Cart::content();
    }

    // Helper Method

    private function checkIsValidProduct($id)
    {
        return Product::find($id);
    }

    private function checkIsValidQty($qty)
    {
        return $qty > 0;
    }


    private function checkIsStockAvailable($stockQty, $orderQty)
    {
        return $stockQty >= $orderQty;
    }

    private function checkIsAlreadyInCart($productId)
    {
        return Cart::content()->firstWhere('id', $productId);
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