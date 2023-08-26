<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Traits\WithSweetAlert;
use App\Models\Caurosel;

class CreateCaurosel extends Component
{
    use WithSweetAlert;

    // From State
    public $name;
    public $show_in_page;
    public $is_published;
    public $image;

    protected $rules = [
        'name' => ['required', 'string', 'unique:caurosels'],
        'show_in_page' => ['required', 'string', 'unique:caurosels'],
        'image' => ['nullable', 'image'],
    ];

    public function render()
    {
        return view('admin.components.create-caurosel');
    }


    public function createCaurosel()
    {
        $this->validate();

        $caurosel = Caurosel::create([
            'name' => $this->name,
            'show_in_page' => $this->show_in_page,
            'is_published' => $this->is_published,
        ]);

        if(!$caurosel) return $this->error('Failed', 'Failed to create Caurosel. Try again');


        $this->reset();
        $this->emit('onCauroselCreated');
        return $this->success('Created', 'Caurosel created successfully');
       
    }

}
