<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\WithSweetAlert;
use App\Models\Slide;

class CreateSlide extends Component
{
    use WithFileUploads;
    use WithSweetAlert;

    // From State
    public $cauroselId;
    public $slide_link;
    public $is_published = true;
    public $image;
    public $old_image;
    public $is_edit_mode_on;
    public $slide_id;

    protected $rules = [
        'slide_link' => ['nullable', 'string'],
        'is_published' => ['required', 'boolean'],
        'image' => ['required', 'image'],
    ];

    protected $listeners = [
        'onSlideEdit' => 'enableSlideEditMode',
    ];

    public function mount($cauroselId)
    {
        $this->cauroselId = $cauroselId;
    }

    public function render()
    {
        return view('admin.components.create-slide');
    }


    public function createSlide()
    {
        $this->validate();

        $Slide = Slide::create([
            'slide_link' => $this->slide_link,
            'is_published' => $this->is_published,
            'caurosel_id' => $this->cauroselId,
        ]);

        if(!$Slide) return $this->error('Failed', 'Failed to create Slide. Try again');

        if($this->image){
            $Slide->addMedia($this->image)->toMediaCollection('image');
            $this->image = null;
            $this->slide_link = null;
            $this->is_published = true;
            $this->emit('onSlideCreated');
            return $this->success('Created', 'Slide created successfully');
        }

        return $this->error('Failed', 'Something went wrong try agian !!');

    }


    public function updateSlide()
    {
        $slide = Slide::find($this->slide_id);

        $slide->slide_link = $this->slide_link;
        $slide->is_published = $this->is_published;
        
        if($this->image){
            $slide->addMedia($this->image)->toMediaCollection('image');
        }

        if($slide->save()){
            $this->image = null;
            $this->old_image = null;
            $this->slide_id = null; 
            $this->is_published = true;
            $this->slide_link = '';
            $this->emit('onSlideUpdated');
            $this->is_edit_mode_on = false;
            return $this->success('Updated', '');
        }

        return $this->error('Failed', 'Something went wrong. Try agian');
    }

    public function enableSlideEditMode($slideId)
    {
 
        $slide = Slide::find($slideId);

        $this->slide_id = $slide->id; 
        $this->slide_link = $slide->slide_link;
        $this->is_published = $slide->is_published;
        $this->old_image = $slide->imageUrl();

        $this->is_edit_mode_on = true;

    }


    public function cancelEditMode()
    {
        $this->image = null;
        $this->old_image = null;
        $this->slide_id = null; 
        $this->is_published = true;
        $this->slide_link = '';
        $this->is_edit_mode_on = false;
    }

    public function removeImage()
    {
        $this->image->delete();
        $this->image = null;
    }
}
