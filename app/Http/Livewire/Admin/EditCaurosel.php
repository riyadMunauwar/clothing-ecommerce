<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Traits\WithSweetAlert;
use App\Models\Caurosel;

class EditCaurosel extends Component
{
    use WithSweetAlert;

    public $is_edit_mode_on = false;

    public $caurosel;


    protected $rules = [
        'caurosel.name' => ['required', 'string'],
        'caurosel.show_in_page' => ['required', 'string', ],
        'caurosel.is_published' => ['required', 'boolean'],
    ];


    protected $listeners = [
        'onCauroselEdit' => 'enableCauroselEditMode',
    ];

    public function render()
    {
        return view('admin.components.edit-caurosel');
    }

    public function updateCaurosel()
    {

        $this->validate();

         if($this->caurosel->save()){

            $this->reset();

            $this->is_edit_mode_on = false;

            $this->emit('onCauroselUpdated');

            return $this->success('Updated', 'Caurosel updated successfully');
        }
        
        return $this->error('Failed', 'Something went wrong. Try again !');

    }


    public function enableCauroselEditMode($id)
    {

        $this->caurosel = caurosel::find($id);

        $this->is_edit_mode_on = true;

    }


    public function cancelEditMode()
    {
        $this->reset();
        $this->is_edit_mode_on = false;
    }
}
