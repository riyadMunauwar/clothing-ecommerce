<?php

namespace App\Observers;

use App\Models\FooterColumn;
use App\Actions\Cache\RemoveCachedFooterItems;

class FooterColumnObserver
{
    /**
     * Handle the FooterColumn "created" event.
     *
     * @param  \App\Models\FooterColumn  $footerColumn
     * @return void
     */
    public function created(FooterColumn $footerColumn)
    {
        new RemoveCachedFooterItems();
    }

    /**
     * Handle the FooterColumn "updated" event.
     *
     * @param  \App\Models\FooterColumn  $footerColumn
     * @return void
     */
    public function updated(FooterColumn $footerColumn)
    {
        new RemoveCachedFooterItems();
    }

    /**
     * Handle the FooterColumn "deleted" event.
     *
     * @param  \App\Models\FooterColumn  $footerColumn
     * @return void
     */
    public function deleted(FooterColumn $footerColumn)
    {
        new RemoveCachedFooterItems();
    }

    /**
     * Handle the FooterColumn "restored" event.
     *
     * @param  \App\Models\FooterColumn  $footerColumn
     * @return void
     */
    public function restored(FooterColumn $footerColumn)
    {
        //
    }

    /**
     * Handle the FooterColumn "force deleted" event.
     *
     * @param  \App\Models\FooterColumn  $footerColumn
     * @return void
     */
    public function forceDeleted(FooterColumn $footerColumn)
    {
        //
    }
}
