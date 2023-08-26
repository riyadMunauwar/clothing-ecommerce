<?php

namespace App\Observers;

use App\Models\Slide;
use Illuminate\Support\Facades\Cache;
use App\Actions\Cache\RemoveCachedSingleCaurosel;

class SlideObserver
{
    /**
     * Handle the Slide "created" event.
     *
     * @param  \App\Models\Slide  $slide
     * @return void
     */
    public function created(Slide $slide)
    {
        new RemoveCachedSingleCaurosel($slide->caurosel->cache_key ?? '');
    }

    /**
     * Handle the Slide "updated" event.
     *
     * @param  \App\Models\Slide  $slide
     * @return void
     */
    public function updated(Slide $slide)
    {
        new RemoveCachedSingleCaurosel($slide->caurosel->cache_key ?? '');
    }

    /**
     * Handle the Slide "deleted" event.
     *
     * @param  \App\Models\Slide  $slide
     * @return void
     */
    public function deleted(Slide $slide)
    {
        new RemoveCachedSingleCaurosel($slide->caurosel->cache_key ?? '');
    }

    /**
     * Handle the Slide "restored" event.
     *
     * @param  \App\Models\Slide  $slide
     * @return void
     */
    public function restored(Slide $slide)
    {
        //
    }

    /**
     * Handle the Slide "force deleted" event.
     *
     * @param  \App\Models\Slide  $slide
     * @return void
     */
    public function forceDeleted(Slide $slide)
    {
        //
    }
}
