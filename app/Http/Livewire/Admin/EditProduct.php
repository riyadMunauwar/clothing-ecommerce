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

class EditProduct extends Component
{
    use WithFileUploads;
    use WithSweetAlert;
    use WithSweetAlertToast;

    public $product_id;
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

    public $is_edit_mode_on = false;

    public $old_thumbnail;
    public $old_gallery = [];

    public $thumbnail;
    public $gallery = [];
    public $categories = [];
    public $brands = [];
    public $categoriesId = [];


    protected $rules = [
        'meta_title' => ['nullable', 'string'],
        'meta_tags' => ['nullable', 'string'],
        'meta_description' => ['nullable', 'string'],
        'name' => ['required', 'string'],
        'slug' => ['required', 'string'],
        'regular_price' => ['nullable', 'numeric'],
        'sale_price' => ['required', 'numeric'],
        'stock_qty' => ['required', 'numeric'],
        'height' => ['nullable', 'string'],
        'width' => ['nullable', 'string'],
        'length' => ['nullable', 'string'],
        'weight' => ['nullable', 'string'],
        'short_description' => ['nullable', 'string'],
        'description' => ['nullable', 'string'],
        'is_premium' => ['required', 'boolean'],
        'is_published' => ['required', 'boolean'],
        'is_featured' => ['required', 'boolean'],
        'is_grocery' => ['required', 'boolean'],
        'brand_id' => ['nullable', 'integer'],
        'thumbnail' => ['nullable','image'],
    ];


    protected $listeners = [
        'onProductEdit' => 'enableProductEditMode',
        'refresh' => '$refresh',
    ];


    public function mount()
    {
        $this->preparedInitData();
    }

    public function render()
    {
        return view('admin.components.edit-product');
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



    public function updateSave()
    {
        $this->validate();

        if($this->youtube_video_url && !$this->validateYouTubeLink($this->youtube_video_url))
        {
            return $this->errorToast('Invalid youtube video link');
        }

        $product = Product::find($this->product_id);

        $product->meta_title = $this->meta_title;
        $product->meta_tags = $this->meta_tags;
        $product->meta_description = $this->meta_description;
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->stock_qty = $this->stock_qty;
        $product->sku = $this->sku;
        $product->weight = $this->weight;
        $product->height = $this->height;
        $product->length = $this->length;
        $product->width = $this->width;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->youtube_video_url = $this->youtube_video_url;
        $product->youtube_video_id = $this->extractYouTubeID($this->youtube_video_url);
        $product->is_featured = $this->is_featured;
        $product->is_published = $this->is_published;
        $product->is_premium = $this->is_premium;
        $product->is_grocery = $this->is_grocery;
        $product->brand_id = $this->brand_id;

        $product->categories()->sync($this->categoriesId);
      
        if($product && $this->thumbnail)
        {
            $product->addMedia($this->thumbnail)->toMediaCollection('thumbnail');
        }


        if($product && count($this->gallery) > 0)
        {
            foreach($this->gallery as $image)
            {
                $product->addMedia($image)->toMediaCollection('gallery');
            }
        }

        if($product->save())
        {
            $this->reset();
            // $this->preparedInitData();
            // $this->clearTinymceState();
            // $this->old_thumbnail = $product->thumbnailUrl('small');
            // $this->thumbnail = null;
            // $this->gallery = [];
            $this->emit('onProductUpdated');
            return $this->success('Updated', 'Product updated successfully');
        }

        return $this->error('Failed', 'Failed to updated');

    }


    public function cancelEditMode()
    {
        $this->reset();
        $this->is_edit_mode_on = false;
    }


    public function enableProductEditMode($id)
    {
        $this->preparedInitData();

        $product = Product::with('categories')->find($id);

        $this->categoriesId = $product->categories->pluck('id')->toArray();

        $this->product_id = $product->id;
        $this->meta_title = $product->meta_title;
        $this->meta_tags = $product->meta_tags;
        $this->meta_description = $product->meta_description;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->regular_price = $product->regular_price;
        $this->sale_price = $product->sale_price;
        $this->stock_qty = $product->stock_qty;
        $this->sku = $product->sku;
        $this->weight = $product->weight;
        $this->height = $product->height;
        $this->length = $product->length;
        $this->width = $product->width;
        $this->short_description = $product->short_description;
        $this->description = $product->description;
        $this->youtube_video_url = $product->youtube_video_url;
        $this->is_featured = $product->is_featured;
        $this->is_published = $product->is_published;
        $this->is_premium = $product->is_premium;
        $this->is_grocery = $product->is_grocery;
        $this->brand_id = $product->brand_id;

        $this->old_thumbnail = $product->thumbnailUrl('small');

        $this->old_gallery = $product->getMedia('gallery');


        $this->is_edit_mode_on = true;
    
        $this->dispatchBrowserEvent('tinymce:init');
        $this->dispatchBrowserEvent('tinymce:set:description', $product->description);
        $this->dispatchBrowserEvent('tinymce:set:short_description', $product->short_description);

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


    public function removeGalleryItem($id)
    {
        $item = $this->old_gallery->find($id);
        $item->delete();
        $this->emit('refresh');
        $this->successToast('Gallery item reomved');
        
    }

    // Component Helper
    private function preparedInitData()
    {
        $this->categories = Category::with('children')->whereNull('parent_id')->get();
        $this->brands = Brand::all();
    }

    private function clearTinymceState()
    {
        return $this->dispatchBrowserEvent('tinymce:clear');
    }


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

}
