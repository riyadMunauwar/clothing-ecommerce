<?php 

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class SweetAlert extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'sweet-alert';
    }
    
}