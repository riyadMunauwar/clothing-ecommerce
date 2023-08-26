<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Slide;
use App\Traits\WithSweetAlert;

class SlideList extends Component
{
    use WithSweetAlert;

    public $search;
    public $caurosel_id;
    public $is_slide_list_show = false;

    protected $listeners = [
        'onSlideCreated' => '$refresh',
        'onSlideUpdated' => '$refresh',
        'onSlideDelete' => 'deleteSlide',
        'onOpenSlideList' => 'openSlideList',
    ];


    public function render()
    {
        $slides = $this->getSlides();

        return view('admin.components.slide-list', compact('slides'));
    }


    public function openSlideList($id)
    {
        $this->caurosel_id = $id;
        $this->is_slide_list_show = true;
    }


    public function confirmDeleteSlide($id)
    {
        return $this->ifConfirmThenDispatch('onSlideDelete', $id, 'Are you sure ?', 'Slide will delete permanently !');
    }


    public function hideSlideList()
    {
        $this->reset();
        $this->is_slide_list_show = false;
    }


    public function enableSlideEditMode($id)
    {
        $this->emit('onSlideEdit', $id);
    }


    public function deleteSlide($id)
    {
        try {
            Slide::destroy($id);
            return $this->success('Success', 'Slide deleted successfully.');
        }catch(\Exception $e)
        {
            return $this->error('Failed', 'Failed to delete Slide. try again');
        }

    }


    private function getSlides()
    {

        $search = $this->search;

        $query = Slide::where('caurosel_id', $this->caurosel_id);

        $query->when($this->search, function($query) use($search){
            $query->where('slide_link', 'like', '%' . $search . '%');
        });

        return $query->paginate(25);

    }
}
