<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;



    public function addressHtml()
    {
        return "{$this->name} </br> {$this->mobile_no} </br> {$this->email} </br> {$this->street}, {$this->city}, {$this->zip}, {$this->state}";
    }

}
