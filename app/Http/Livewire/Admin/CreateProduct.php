<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Traits\WithSweetAlert;
use App\Traits\WithSweetAlertToast;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Variation;
use Illuminate\Support\Facades\DB;


class CreateProduct extends Component
{
    use WithFileUploads;
    use WithSweetAlert;
    use WithSweetAlertToast;

    public $meta_title;
    public $meta_tags;
    public $meta_description;
    public $name;
    public $slug;
    public $regular_price;
    public $sale_price;
    public $stock_qty;
    public $sku;
    public $weight;
    public $weight_unit;
    public $dimension_unit;
    public $height;
    public $length;
    public $width;
    public $short_description;
    public $description;
    public $youtube_video_url;
    public $is_featured = false;
    public $is_published = true;
    public $is_premium = false;
    public $is_grocery = false;
    public $brand_id;


    public $variationOptions = [];
    public $thumbnail;
    public $gallery = [];
    public $categories = [];
    public $brands = [];
    public $categoriesId = [];

    public $variations = [];
    public $options = [];

    public $attributeName;
    public $attributeValues;


    protected $rules = [
        'meta_title' => ['nullable', 'string'],
        'meta_tags' => ['nullable', 'string'],
        'meta_description' => ['nullable', 'string'],
        'name' => ['nullable', 'string'],
        'slug' => ['nullable', 'string'],
        'regular_price' => ['nullable', 'numeric'],
        'sale_price' => ['nullable', 'numeric'],
        'stock_qty' => ['nullable', 'numeric'],
        'height' => ['nullable', 'string'],
        'width' => ['nullable', 'string'],
        'length' => ['nullable', 'string'],
        'weight' => ['nullable', 'string'],
        'short_description' => ['nullable', 'string'],
        'description' => ['nullable', 'string'],
        'youtube_video_url' => ['nullable', 'string'],
        'is_premium' => ['nullable', 'boolean'],
        'is_published' => ['nullable', 'boolean'],
        'is_featured' => ['nullable', 'boolean'],
        'is_grocery' => ['nullable', 'boolean'],
        'brand_id' => ['nullable', 'integer'],
        'thumbnail' => ['nullable','image'],

        'variations.*.image' => ['nullable', 'image'],
        'variations.*.sale_price' => ['nullable', 'numeric'],
        'variations.*.regular_price' => ['nullable', 'numeric'],
        'variations.*.sku' => ['nullable', 'string'],
        'variations.*.stock_qty' => ['nullable', 'numeric'],
        'variations.*.width' => ['nullable', 'numeric'],
        'variations.*.height' => ['nullable', 'numeric'],
        'variations.*.length' => ['nullable', 'numeric'],
        'variations.*.weight' => ['nullable', 'numeric'],
    ];


    public function mount()
    {
        $this->preparedInitData();
    }

    public function render()
    {
        return view('admin.components.create-product');
    }


    public function updated($attribute, $value)
    {
        switch($attribute){

            case 'sale_price': 
                if(empty($value)){
                    $this->sale_price = null;
                }
                break;
            case 'regular_price':
                if(empty($value)){
                    $this->regular_price = null;
                }
                break;
            case 'stock_qty':
                if(empty($value)){
                    $this->stock_qty = null;
                }
                break;
            case 'width':
                if(empty($value)){
                    $this->width = null;
                }
                break;
            case 'height':
                if(empty($value)){
                    $this->height = null;
                }
                break;
            case 'length':
                if(empty($value)){
                    $this->length = null;
                }
                break;
            case 'weight':
                if(empty($value)){
                    $this->weight = null;
                }
                break;
 
        }
    }


    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function createProduct()
    {
        $this->validate();

        if($this->youtube_video_url && !$this->validateYouTubeLink($this->youtube_video_url))
        {
            return $this->errorToast('Invalid youtube video link');
        }

        if(count($this->variations) > 0){
            $this->validateVariations();
        }else {
            $this->validateProduct();
        }

        
        try{

            DB::transaction(function(){

                $product = Product::create($this->newProduct());

                if(count($this->categoriesId) > 0){
                    $product->categories()->attach($this->categoriesId);
                }

                if($this->thumbnail){
                    $product->addMedia($this->thumbnail)->toMediaCollection('thumbnail');
                }

                if($this->gallery){

                    foreach($this->gallery as $image)
                    {
                        $product->addMedia($image)->toMediaCollection('gallery');
                    }

                }

                foreach($this->variations as $variation)
                {
                    $variation['product_id'] = $product->id;

                    $image = $variation['image'];

                    // unset($variation['image']);
                    // unset($variation['_id']);

                    $variant = Variation::create($variation);

                    if($image){
                        $variant->addMedia($image)->toMediaCollection('image');
                    }

                }

            });

            $this->reset();
            $this->preparedInitData();
            $this->clearTinymceState();
            return $this->success('Created', 'Product created successfully');

        }catch(\Exception $e){
            $this->error('Failed', 'Something went wrong !' . $e->getMessage());
        }

    }


    public function removeThumbnail()
    {
        $this->thumbnail->delete();
        $this->thumbnail = null;
    }


    public function removeGallery()
    {
        foreach($this->gallery as $image)
        {
            $image->delete();
        }

        $this->gallery = [];
    }


    public function addAttribute()
    {
        if(empty($this->attributeName) || empty($this->attributeValues))
        {
            return $this->errorToast('Attribute name or Values must not be empty');
        }

        $this->validate([
            'attributeName' => ['required', 'string'],
            'attributeValues' => ['required', 'string'],
        ]);

        $attribute = ucfirst(trim($this->attributeName));
        $valuesArray = $this->capitalizeArray($this->split($this->attributeValues));

        $this->variationOptions[$attribute] = $valuesArray;

        $this->attributeName = '';
        $this->attributeValues = '';

        return $this->successToast('Attribute created');

    }


    public function removeAttribute($attribute)
    {   
        if(count($this->variations) > 0){
            return $this->infoToast('Remove all the variation first');
        }

        unset($this->variationOptions[$attribute]);
        return $this->successToast('Attribute remove');
    }


    public function resetAttributeOptions()
    {
        if(count($this->variations) > 0){
            return $this->infoToast('Remove all the variation first');
        }

        $this->variationOptions = [];
        return $this->successToast('Attribute reset');
    }



    public function createVariations()
    {

        if($this->isArrayEmpty($this->variationOptions)){
            return $this->errorToast('No attribute available !');
        }

        $variationOptions = $this->generateVariations($this->variationOptions);

        $variations = [];

        foreach($variationOptions as $index => $option)
        {
            array_push($variations, $this->singleVariationSchema($option, $index));
        }

        $this->variations = $variations;

        return $this->successToast('Variation generated successfully');

    }

    public function removeVariation($id)
    {
        $targetVariantIndex = array_search($id, array_column($this->variations, '_id'));
        $targetVariant = $this->variations[$targetVariantIndex];

        if($targetVariant['image']){
            $targetVariant['image']->delete();
        }
        
        unset($this->variations[$targetVariantIndex]);
        return $this->successToast('1 variation item removed');
    }


    public function removeAllVariation()
    {
        foreach($this->variations as $variant)
        {
            if($variant['image']){
                $variant['image']->delete();
            }
        }

        $this->variations = [];
        return $this->successToast('All veriation removed');
    }


    public function removeVariantImage($variationId)
    {
        $this->variations = array_map(function($variant) use($variationId){
            
            if($variant['_id'] === $variationId){
                $variant['image']->delete();
                $variant['image'] = null;
                return $variant;
            }

            return $variant;
        }, $this->variations);
    }


    // Component Helper
    private function preparedInitData()
    {
        $this->categories = Category::with('children')->whereNull('parent_id')->get();
        $this->brands = Brand::all();
    }


    // Helper function

    private function validateYouTubeLink($link) {
        $regex = '/^(http(s)?:\/\/)?((w){3}.)?youtu(be|.be)?(\.com)?\/.+$/';
        if(preg_match($regex, $link)) {
          parse_str(parse_url($link, PHP_URL_QUERY), $params);
          if(isset($params['v']) && strlen($params['v']) == 11) {
            return true;
          }
        }
        return false;
    }

    private function extractYouTubeID($link) {

        if(!$link) return null;

        $regex = '/^(http(s)?:\/\/)?((w){3}.)?youtu(be|.be)?(\.com)?\/.+$/';

        if(preg_match($regex, $link)) {
          parse_str(parse_url($link, PHP_URL_QUERY), $params);
          if(isset($params['v']) && strlen($params['v']) == 11) {
            return $params['v'];
          }
        }

        return null;

    }


    private function newProduct()
    {
        return [
            'meta_title' => $this->meta_title,
            'meta_tags' => $this->meta_tags,
            'meta_description' => $this->meta_description,
            'name' => $this->name,
            'slug' => $this->slug,
            'sale_price' => $this->sale_price,
            'regular_price' => $this->regular_price,
            'stock_qty' => $this->stock_qty,
            'sku' => $this->sku,
            'weight' => $this->weight,
            'height' => $this->height,
            'width' => $this->width,
            'length' => $this->length,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'youtube_video_url' => $this->youtube_video_url,
            'youtube_video_id' => $this->extractYouTubeID($this->youtube_video_url),
            'variation_options' => $this->variationOptions,
            'is_featured' => $this->is_featured,
            'is_premium' => $this->is_premium,
            'is_published' => $this->is_published,
            'is_grocery' => $this->is_grocery,
            'brand_id' => $this->brand_id,
        ];
    }


    private function validateProduct()
    {
        $this->validate([
            'name' => ['required', 'string'],
            'slug' => ['required', 'string', 'unique:products'],
            'regular_price' => ['nullable', 'numeric'],
            'sale_price' => ['required', 'numeric'],
            'stock_qty' => ['required', 'numeric'],
            'short_description' => ['nullable', 'string'],
            'thumbnail' => ['required','image'],
        ]);
    }


    private function validateVariations()
    {
        $this->validate([
            'name' => ['required', 'string'],
            'slug' => ['required', 'string', 'unique:products'],
            'thumbnail' => ['required','image'],
            'variations.*.image' => ['required', 'image'],
            'variations.*.sale_price' => ['required', 'numeric'],
            'variations.*.regular_price' => ['nullable', 'numeric'],
            'variations.*.stock_qty' => ['required', 'numeric'],
        ]);
    }


    private function clearTinymceState()
    {
        return $this->dispatchBrowserEvent('tinymce:clear');
    }


    private function split(string $string) : array
    {
        $parts = preg_split('/[,|\s]+/', trim($string));

        $parts = array_filter($parts, function($part) {
          return !empty($part);
        });
      
        return $parts;
    }

    private function capitalizeArray(array $strings): array {
        $capitalized = array_map('ucfirst', $strings);
        return $capitalized;
    }


    private function isArrayEmpty($array) {

        if (!is_array($array)) {
            return true; 
        }
        
        foreach ($array as $key => $value) {
            if (empty($key) || empty($value)) {
                return true;
            }
        }
        
        return false; 
    }

    private function singleVariationSchema($variationOptions, $index)
    {
        $baseVariant = [
            '_id' => $index + 1,
            'sale_price' => 0,
            'regular_price' => 0,
            'stock_qty' => 0,
            'options' => $variationOptions,
            'weight' => 0,
            'height' => 0,
            'length' => 0,
            'width' => 0,
            'sku' => '',
            'image' => null,
        ];

        return $baseVariant;
    }


    private function generateVariations($attributes, $currentVariation = array(), $index = 0) {
        // If we've reached the last attribute, we add the current variation to the result set
        if ($index >= count($attributes)) {
            return array($currentVariation);
        }
    
        $result = array();
    
        // Loop through each value of the current attribute and recursively call the function
        foreach ($attributes[array_keys($attributes)[$index]] as $value) {
            $variation = $currentVariation;
            $variation[array_keys($attributes)[$index]] = $value;
            $result = array_merge($result, $this->generateVariations($attributes, $variation, $index + 1));
        }
    
        return $result;
    }
}
