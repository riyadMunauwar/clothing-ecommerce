<?php

namespace App\Observers;

use App\Models\SocialLink;
use App\Actions\Cache\RemoveCachedSocialLinkList;

class SocialLinkObserver
{
    /**
     * Handle the SocialLink "created" event.
     *
     * @param  \App\Models\SocialLink  $socialLink
     * @return void
     */
    public function created(SocialLink $socialLink)
    {
        new RemoveCachedSocialLinkList();
    }

    /**
     * Handle the SocialLink "updated" event.
     *
     * @param  \App\Models\SocialLink  $socialLink
     * @return void
     */
    public function updated(SocialLink $socialLink)
    {
        new RemoveCachedSocialLinkList();
    }

    /**
     * Handle the SocialLink "deleted" event.
     *
     * @param  \App\Models\SocialLink  $socialLink
     * @return void
     */
    public function deleted(SocialLink $socialLink)
    {
        new RemoveCachedSocialLinkList();
    }

    /**
     * Handle the SocialLink "restored" event.
     *
     * @param  \App\Models\SocialLink  $socialLink
     * @return void
     */
    public function restored(SocialLink $socialLink)
    {
        //
    }

    /**
     * Handle the SocialLink "force deleted" event.
     *
     * @param  \App\Models\SocialLink  $socialLink
     * @return void
     */
    public function forceDeleted(SocialLink $socialLink)
    {
        //
    }
}
