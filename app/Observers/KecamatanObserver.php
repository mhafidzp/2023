<?php

namespace App\Observers;

use App\Models\Kecamatan;
use Illuminate\Support\Str;

class KecamatanObserver
{
    /**
     * Handle the Kecamatan "created" event.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return void
     */

    public function creating(Kecamatan $kecamatan)
    {
        $kecamatan->created_by = '1';
        $kecamatan->updated_by = '1';
        $kecamatan->slug = Str::slug($kecamatan->nama);
    }

    public function created(Kecamatan $kecamatan)
    {
        //
    }

    /**
     * Handle the Kecamatan "updated" event.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return void
     */
    public function updated(Kecamatan $kecamatan)
    {
        $kecamatan->updated_by = '1';
    }

    /**
     * Handle the Kecamatan "deleted" event.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return void
     */
    public function deleted(Kecamatan $kecamatan)
    {
        //
    }

    /**
     * Handle the Kecamatan "restored" event.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return void
     */
    public function restored(Kecamatan $kecamatan)
    {
        //
    }

    /**
     * Handle the Kecamatan "force deleted" event.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return void
     */
    public function forceDeleted(Kecamatan $kecamatan)
    {
        //
    }
}
