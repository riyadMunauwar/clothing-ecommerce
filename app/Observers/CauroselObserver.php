<?php

namespace App\Observers;

use App\Models\Caurosel;
use Illuminate\Support\Facades\Cache;
use App\Actions\Cache\RemoveCachedSingleCaurosel;

class CauroselObserver
{
    /**
     * Handle the Caurosel "created" event.
     *
     * @param  \App\Models\Caurosel  $caurosel
     * @return void
     */
    public function created(Caurosel $caurosel)
    {
        //
    }

    /**
     * Handle the Caurosel "updated" event.
     *
     * @param  \App\Models\Caurosel  $caurosel
     * @return void
     */
    public function updated(Caurosel $caurosel)
    {
        new RemoveCachedSingleCaurosel($caurosel->cache_key ?? '');
    }

    /**
     * Handle the Caurosel "deleted" event.
     *
     * @param  \App\Models\Caurosel  $caurosel
     * @return void
     */
    public function deleted(Caurosel $caurosel)
    {
        new RemoveCachedSingleCaurosel($caurosel->cache_key ?? '');
    }

    /**
     * Handle the Caurosel "restored" event.
     *
     * @param  \App\Models\Caurosel  $caurosel
     * @return void
     */
    public function restored(Caurosel $caurosel)
    {
        //
    }

    /**
     * Handle the Caurosel "force deleted" event.
     *
     * @param  \App\Models\Caurosel  $caurosel
     * @return void
     */
    public function forceDeleted(Caurosel $caurosel)
    {
        //
    }
}
