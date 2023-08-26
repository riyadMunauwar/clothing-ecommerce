<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSweetAlert;
use App\Models\Page;

class PageList extends Component
{
    use WithPagination;
    use WithSweetAlert;

    public $search;

    protected $listeners = [
        'onPageCreated' => '$refresh',
        'onPageUpdated' => '$refresh',
        'onPageDelete' => 'deletePage',
    ];


    public function render()
    {
        $pages = $this->getPages();

        return view('admin.components.page-list', compact('pages'));
    }


    public function enablePageEditMode($id)
    {
        $this->emit('onPageEdit', $id);
    }


    public function confirmDeletePage($id)
    {
        return $this->ifConfirmThenDispatch('onPageDelete', $id, 'Are you sure ?', 'Page will delete permanently !');
    }


    public function deletePage($id)
    {
        if(Page::destroy($id)){
            return $this->success('Success', 'Page deleted successfully.');
        }

        return $this->error('Failed', 'Failed to delete Page. try again');
    }


    private function getPages()
    {

        $search = $this->search;

        $query = Page::query();

        $query->when($this->search, function($query) use($search){
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('name', $search);
        });

        return $query->paginate(25);

    }
}
