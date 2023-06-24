<?php

namespace App\Observers;

use App\Models\Provinsi;
use Illuminate\Support\Str;
use Auth;

class ProvinsiObserver
{
    /**
     * Handle the Provinsi "created" event.
     *
     * @param  \App\Models\Provinsi  $provinsi
     * @return void
     */
    public function creating(Provinsi $provinsi)
    {
        $provinsi->created_by = (Auth::guard('admin')->user()) ? Auth::guard('admin')->user()->id : '1';
        $provinsi->updated_by = (Auth::guard('admin')->user()) ? Auth::guard('admin')->user()->id : '1';
        $provinsi->slug = Str::slug($provinsi->nama);
    }

    public function created(Provinsi $provinsi)
    {
        //
    }

    /**
     * Handle the Provinsi "updated" event.
     *
     * @param  \App\Models\Provinsi  $provinsi
     * @return void
     */
    public function updated(Provinsi $provinsi)
    {
        $provinsi->updated_by = (Auth::guard('admin')->user()) ? Auth::guard('admin')->user()->id : '1';
    }

    /**
     * Handle the Provinsi "deleted" event.
     *
     * @param  \App\Models\Provinsi  $provinsi
     * @return void
     */
    public function deleted(Provinsi $provinsi)
    {
        //
    }

    /**
     * Handle the Provinsi "restored" event.
     *
     * @param  \App\Models\Provinsi  $provinsi
     * @return void
     */
    public function restored(Provinsi $provinsi)
    {
        //
    }

    /**
     * Handle the Provinsi "force deleted" event.
     *
     * @param  \App\Models\Provinsi  $provinsi
     * @return void
     */
    public function forceDeleted(Provinsi $provinsi)
    {
        //
    }
}
