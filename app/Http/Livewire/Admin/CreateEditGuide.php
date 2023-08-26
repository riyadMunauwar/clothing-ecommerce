<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Traits\WithSweetAlert;
use App\Traits\WithSweetAlertToast;
use App\Models\Guide;

class CreateEditGuide extends Component
{
    use WithSweetAlert;
    use WithSweetAlertToast;

    public $is_edit_mode_on = false;

    public $title;
    public $slug;
    public $show_in_page;
    public $guide_youtube_video_url;
    public $guide_youtube_video_id;
    public $content;
    public $is_published;

    public $guide_id;


    protected $rules = [
        'title' => ['required', 'string', 'max:255'],
        'slug' => ['required', 'string', 'unique:guides', 'max:255'],
        'show_in_page' => ['required', 'string', 'max:255'],
        'guide_youtube_video_url' => ['nullable', 'string', 'max:255'],
        'content' => ['nullable', 'string'],
        'is_published' => ['required', 'boolean'],
    ];

    protected $listeners = [
        'onGuideEdit' => 'enableGuideEditMode',
    ];

    public function render()
    {
        return view('admin.components.create-edit-guide');
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function createGuide()
    {
        $this->validate();

        if(!$this->validateYouTubeLink($this->guide_youtube_video_url)){
            return $this->errorToast('Invalid youtube video url');
        }

        $guide = new Guide();

        $guide->title = $this->title;
        $guide->slug = $this->slug;
        $guide->content = $this->content;
        $guide->show_in_page = $this->show_in_page;
        $guide->guide_youtube_video_url = $this->guide_youtube_video_url;
        $guide->is_published = $this->is_published;
        $guide->guide_youtube_video_id = $this->extractYouTubeID($this->guide_youtube_video_url);

        if(!$guide->save()) return $this->error('Failed', 'Failed to create new Guide. Something went wrong.');

        $this->reset();
        $this->emit('onGuideCreated');
        $this->dispatchBrowserEvent('tinymce:clear');
        $this->success('Created', '');
    }


    public function updateGuide()
    {
        $this->validate([
            'title' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'is_published' => ['required', 'boolean'],
        ]);

        if(!$this->validateYouTubeLink($this->guide_youtube_video_url)){
            return $this->errorToast('Invalid youtube video url');
        }

        $guide = Guide::find($this->guide_id);

        $guide->title = $this->title;
        $guide->slug = $this->slug;
        $guide->content = $this->content;
        $guide->show_in_page = $this->show_in_page;
        $guide->guide_youtube_video_url = $this->guide_youtube_video_url;
        $guide->is_published = $this->is_published;
        $guide->guide_youtube_video_id = $this->extractYouTubeID($this->guide_youtube_video_url);

        if(!$guide->save()) return $this->error('Failed', 'Failed to updated Guide. Something went wrong.');

        $this->reset();
        $this->emit('onGuideUpdated');
        $this->dispatchBrowserEvent('tinymce:clear');
        $this->success('Updated', '');

    }

    public function enableGuideEditMode($id)
    {
        $guide = Guide::find($id);

        $this->guide_id = $guide->id;
        $this->title = $guide->title;
        $this->slug = $guide->slug;
        $this->content = $guide->content;
        $this->show_in_page = $guide->show_in_page;
        $this->guide_youtube_video_url = $guide->guide_youtube_video_url;
        $this->is_published = $guide->is_published;

        $this->dispatchBrowserEvent('tinymce:set:content', $this->content);

        $this->is_edit_mode_on = true;
    }

    public function cancelEditMode()
    {
        $this->reset();
        $this->dispatchBrowserEvent('tinymce:clear');
        $this->is_edit_mode_on = false;
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
