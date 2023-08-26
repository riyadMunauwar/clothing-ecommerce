<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\WithSweetAlert;
use Illuminate\Support\Facades\Storage;
use App\Models\Supplier;


class CreateSupplier extends Component
{
    use WithFileUploads;
    use WithSweetAlert;

    // From State

    public $name;
    public $city;
    public $state;
    public $country;
    public $phone;
    public $email;
    public $address;
    public $contact_person_name;
    public $contact_person_email;
    public $contact_person_phone;
    public $logo;



    protected $rules = [
        'name' => ['required', 'string', 'unique:suppliers'],
        'city' => ['nullable', 'string'],
        'state' => ['nullable', 'string'],
        'country' => ['nullable', 'string'],
        'phone' => ['nullable', 'string'],
        'email' => ['nullable', 'string', 'email'],
        'address' => ['nullable', 'string'],
        'contact_person_name' => ['nullable', 'string'],
        'contact_person_email' => ['nullable', 'string', 'email'],
        'contact_person_phone' => ['nullable', 'string'],
        'logo' => ['nullable', 'image'],
    ];


    public function render()
    {
        return view('admin.components.create-supplier');
    }


    public function createSupplier()
    {
        $this->validate();

        $supplier = Supplier::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'address' => $this->address,
            'contact_person_name' => $this->contact_person_name,
            'contact_person_phone' => $this->contact_person_phone,
            'contact_person_email' => $this->contact_person_email,
        ]);


        if(!$supplier) return $this->error('Failed', 'Failed to create supplier. Try again');

        if($this->logo){
            $supplier->addMedia($this->logo)->toMediaCollection('logo');
        }

        $this->reset();
        $this->emit('onSuppplierCreated');
        return $this->success('Created', 'Supplier created successfully');

    }


    public function removeLogo()
    {
        $this->logo->delete();
        $this->logo = null;
    }

}
