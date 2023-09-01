<?php

namespace App\Observers;

use App\Models\Kota;
use Illuminate\Support\Str;

class KotaObserver
{
    /**
     * Handle the Kota "created" event.
     *
     * @param  \App\Models\Kota  $kota
     * @return void
     */
    public function creating(Kota $kota)
    {
        $kota->created_by = '1';
        $kota->updated_by = '1';
        $kota->slug = Str::slug($kota->nama);
    }

    public function created(Kota $kota)
    {
        //
    }

    /**
     * Handle the Kota "updated" event.
     *
     * @param  \App\Models\Kota  $kota
     * @return void
     */
    public function updated(Kota $kota)
    {
        $kota->updated_by = '1';
    }

    /**
     * Handle the Kota "deleted" event.
     *
     * @param  \App\Models\Kota  $kota
     * @return void
     */
    public function deleted(Kota $kota)
    {
        //
    }

    /**
     * Handle the Kota "restored" event.
     *
     * @param  \App\Models\Kota  $kota
     * @return void
     */
    public function restored(Kota $kota)
    {
        //
    }

    /**
     * Handle the Kota "force deleted" event.
     *
     * @param  \App\Models\Kota  $kota
     * @return void
     */
    public function forceDeleted(Kota $kota)
    {
        //
    }
}
