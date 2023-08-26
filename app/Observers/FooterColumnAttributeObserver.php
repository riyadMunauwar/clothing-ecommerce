<?php

namespace App\Observers;

use App\Models\FooterColumnAttribute;
use App\Actions\Cache\RemoveCachedFooterItems;

class FooterColumnAttributeObserver
{
    /**
     * Handle the FooterColumnAttribute "created" event.
     *
     * @param  \App\Models\FooterColumnAttribute  $footerColumnAttribute
     * @return void
     */
    public function created(FooterColumnAttribute $footerColumnAttribute)
    {
        new RemoveCachedFooterItems();
    }

    /**
     * Handle the FooterColumnAttribute "updated" event.
     *
     * @param  \App\Models\FooterColumnAttribute  $footerColumnAttribute
     * @return void
     */
    public function updated(FooterColumnAttribute $footerColumnAttribute)
    {
        new RemoveCachedFooterItems();
    }

    /**
     * Handle the FooterColumnAttribute "deleted" event.
     *
     * @param  \App\Models\FooterColumnAttribute  $footerColumnAttribute
     * @return void
     */
    public function deleted(FooterColumnAttribute $footerColumnAttribute)
    {
        new RemoveCachedFooterItems();
    }

    /**
     * Handle the FooterColumnAttribute "restored" event.
     *
     * @param  \App\Models\FooterColumnAttribute  $footerColumnAttribute
     * @return void
     */
    public function restored(FooterColumnAttribute $footerColumnAttribute)
    {
        //
    }

    /**
     * Handle the FooterColumnAttribute "force deleted" event.
     *
     * @param  \App\Models\FooterColumnAttribute  $footerColumnAttribute
     * @return void
     */
    public function forceDeleted(FooterColumnAttribute $footerColumnAttribute)
    {
        //
    }
}
