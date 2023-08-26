<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSweetAlert;
use App\Models\Banner;

class BannerList extends Component
{
    use WithPagination;
    use WithSweetAlert;

    public $search;

    protected $listeners = [
        'onBannerCreated' => '$refresh',
        'onBannerUpdated' => '$refresh',
        'onBannerDelete' => 'deleteBanner',
    ];


    public function render()
    {
        $banners = $this->getBanners();

        return view('admin.components.banner-list', compact('banners'));
    }


    public function enableBannerEditMode($id)
    {
        $this->emit('onBannerEdit', $id);
    }


    public function confirmDeleteBanner($id)
    {
        return $this->ifConfirmThenDispatch('onBannerDelete', $id, 'Are you sure ?', 'Banner will delete permanently !');
    }


    public function deleteBanner($id)
    {
        try {
            Banner::destroy($id);
            return $this->success('Success', 'Banner deleted successfully.');
        }catch(\Exception $e)
        {
            return $this->error('Failed', 'Failed to delete Banner. try again');
        }

    }


    private function getBanners()
    {

        $search = $this->search;

        $query = Banner::query();

        $query->when($this->search, function($query) use($search){
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('name', $search);
        });

        return $query->paginate(25);

    }
}
