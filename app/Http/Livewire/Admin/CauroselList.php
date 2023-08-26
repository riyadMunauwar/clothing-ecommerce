<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSweetAlert;
use App\Models\Caurosel;

class CauroselList extends Component
{
    use WithPagination;
    use WithSweetAlert;

    public $search;

    protected $listeners = [
        'onCauroselCreated' => '$refresh',
        'onCauroselUpdated' => '$refresh',
        'onCauroselDelete' => 'deleteCaurosel',
    ];


    public function render()
    {
        $caurosels = $this->getCaurosels();

        return view('admin.components.caurosel-list', compact('caurosels'));
    }


    public function enableCauroselEditMode($id)
    {
        $this->emit('onCauroselEdit', $id);
    }


    public function confirmDeleteCaurosel($id)
    {
        return $this->ifConfirmThenDispatch('onCauroselDelete', $id, 'Are you sure ?', 'Caurosel will delete permanently !');
    }


    public function deleteCaurosel($id)
    {
        try {
            Caurosel::destroy($id);
            return $this->success('Success', 'Caurosel deleted successfully.');
        }catch(\Exception $e)
        {
            return $this->error('Failed', 'Failed to delete Caurosel. try again');
        }

    }

    public function openSlideList($cauroselId)
    {
        $this->emit('onOpenSlideList', $cauroselId);
    }


    private function getCaurosels()
    {

        $search = $this->search;

        $query = Caurosel::query();

        $query->when($this->search, function($query) use($search){
            $query->where('name', 'like', '%' . $search . '%')->orWhere('name', $search);
        });

        return $query->paginate(25);

    }
}
