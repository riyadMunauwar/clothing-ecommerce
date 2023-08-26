<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Variation;
use App\Traits\WithSweetAlert;

class EditVariation extends Component
{
    use WithFileUploads;
    use WithSweetAlert;

    public $is_edit_mode_on = false;
    public $new_image;
    public $old_image;

    public $variation;

    protected $listeners = [
        'onVariationEdit' => 'enableVariationEditMode',
    ];


    protected $rules = [
        'variation.sale_price' => ['required', 'numeric'],
        'variation.regular_price' => ['required', 'numeric'],
        'variation.stock_qty' => ['required', 'integer'],
        'variation.weight' => ['nullable', 'numeric'],
        'variation.sku' => ['nullable', 'string'],
        'variation.height' => ['nullable', 'numeric'],
        'variation.width' => ['nullable', 'numeric'],
        'variation.length' => ['nullable', 'numeric'],
        'variation.is_published' => ['required', 'boolean'],
        'old_image' => ['required_without_all:new_image', 'string'],
        'new_image' => ['required_without_all:old_image'],
    ];


    public function render()
    {
        return view('admin.components.edit-variation');
    }
    

    public function updated($attribute, $value)
    {

        switch($attribute){

            case 'variation.sale_price': 
                if(empty($value)){
                    $this->variation->sale_price = null;
                }
                break;
            case 'variation.regular_price':
                if(empty($value)){
                    $this->variation->regular_price = null;
                }
                break;
            case 'variation.stock_qty':
                if(empty($value)){
                    $this->variation->stock_qty = null;
                }
                break;
            case 'variation.width':
                if(empty($value)){
                    $this->variation->width = null;
                }
                break;
            case 'variation.height':
                if(empty($value)){
                    $this->variation->height = null;
                }
                break;
            case 'variation.length':
                if(empty($value)){
                    $this->variation->length = null;
                }
                break;
            case 'variation.weight':
                if(empty($value)){
                    $this->variation->weight = null;
                }
                break;
 
        }
    }

    public function updateVariation()
    {

        $this->validate();

        if($this->new_image){
            $this->variation->addMedia($this->new_image)->toMediaCollection('image');
        }


        if($this->variation->save()){

            $this->is_edit_mode_on = false;

            $this->emit('onVariationUpdated');

            $this->emit('onVariatioShow', $this->variation->product_id);

            $this->reset();

            return $this->success('Updated', 'Variation updated successfully');
        }
        
        return $this->error('Failed', 'Something went wrong. Try again !');

    }


    public function enableVariationEditMode($id)
    {

        $this->variation = Variation::find($id);

        $this->old_image = $this->variation->imageUrl('small');

        $this->is_edit_mode_on = true;

    }


    public function removeImage()
    {
        $this->new_image->delete();
        $this->new_image = null;
    }


    public function cancelEditMode()
    {
        $this->emit('onVariatioShow', $this->variation->product_id);
        $this->reset();
        $this->is_edit_mode_on = false;
    }
}
