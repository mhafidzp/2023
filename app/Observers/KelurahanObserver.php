<?php

namespace App\Observers;

use App\Models\Kelurahan;
use Illuminate\Support\Str;

class KelurahanObserver
{
    /**
     * Handle the Kelurahan "created" event.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return void
     */

    public function creating(Kelurahan $kelurahan)
    {
        $kelurahan->created_by = '1';
        $kelurahan->updated_by = '1';
        $kelurahan->slug = Str::slug($kelurahan->nama);
    }

    public function created(Kelurahan $kelurahan)
    {
        //
    }

    /**
     * Handle the Kelurahan "updated" event.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return void
     */
    public function updated(Kelurahan $kelurahan)
    {
        $kelurahan->updated_by = '1';
    }

    /**
     * Handle the Kelurahan "deleted" event.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return void
     */
    public function deleted(Kelurahan $kelurahan)
    {
        //
    }

    /**
     * Handle the Kelurahan "restored" event.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return void
     */
    public function restored(Kelurahan $kelurahan)
    {
        //
    }

    /**
     * Handle the Kelurahan "force deleted" event.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return void
     */
    public function forceDeleted(Kelurahan $kelurahan)
    {
        //
    }
}
