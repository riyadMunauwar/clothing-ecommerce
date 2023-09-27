<div class="product-action">
    <button wire:click.debounce="addToCartHandeler" class="btn-product btn-cart"><span wire:loading.remove wire:target="addToCartHandeler" >add to cart</span><span wire:loading wire:target="addToCartHandeler">Processing...</span></button>
</div>