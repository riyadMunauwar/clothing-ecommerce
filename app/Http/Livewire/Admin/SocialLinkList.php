<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithSweetAlert;
use App\Models\SocialLink;

class SocialLinkList extends Component
{
    use WithPagination;
    use WithSweetAlert;

    public $search;

    protected $listeners = [
        'onSocialLinkCreated' => '$refresh',
        'onSocialLinkUpdated' => '$refresh',
        'onSocialLinkDelete' => 'deleteSocialLink',
    ];


    public function render()
    {
        $socialLinks = $this->getSocialLinks();

        return view('admin.components.social-link-list', compact('socialLinks'));
    }


    public function enableSocialLinkEditMode($id)
    {
        $this->emit('onSocialLinkEdit', $id);
    }


    public function confirmDeleteSocialLink($id)
    {
        return $this->ifConfirmThenDispatch('onSocialLinkDelete', $id, 'Are you sure ?', 'SocialLink will delete permanently !');
    }


    public function deleteSocialLink($id)
    {
        try {
            SocialLink::destroy($id);
            return $this->success('Success', 'SocialLink deleted successfully.');
        }catch(\Exception $e)
        {
            return $this->error('Failed', 'Failed to delete SocialLink. try again');
        }

    }


    private function getSocialLinks()
    {

        $search = $this->search;

        $query = SocialLink::query();

        $query->when($this->search, function($query) use($search){
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('name', $search);
        });

        return $query->paginate(25);

    }
}
