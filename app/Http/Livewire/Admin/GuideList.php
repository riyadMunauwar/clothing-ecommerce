<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSweetAlert;
use App\Models\Guide;

class GuideList extends Component
{
    use WithPagination;
    use WithSweetAlert;

    public $search;

    protected $listeners = [
        'onGuideCreated' => '$refresh',
        'onGuideUpdated' => '$refresh',
        'onGuideDelete' => 'deleteGuide',
    ];


    public function render()
    {
        $guides = $this->getGuides();

        return view('admin.components.Guide-list', compact('guides'));
    }


    public function enableGuideEditMode($id)
    {
        $this->emit('onGuideEdit', $id);
    }


    public function confirmDeleteGuide($id)
    {
        return $this->ifConfirmThenDispatch('onGuideDelete', $id, 'Are you sure ?', 'Guide will delete permanently !');
    }


    public function deleteGuide($id)
    {
        if(Guide::destroy($id)){
            return $this->success('Success', 'Guide deleted successfully.');
        }

        return $this->error('Failed', 'Failed to delete Guide. try again');
    }


    private function getGuides()
    {

        $search = $this->search;

        $query = Guide::query();

        $query->when($this->search, function($query) use($search){
            $query->where('title', 'like', '%' . $search . '%')
                  ->orWhere('title', $search);
        });

        return $query->paginate(25);

    }
}
