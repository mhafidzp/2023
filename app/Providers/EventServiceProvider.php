<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Observers\ProvinsiObserver;
use App\Observers\KotaObserver;
use App\Observers\KecamatanObserver;
use App\Observers\KelurahanObserver;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Provinsi::observe(ProvinsiObserver::class);
        Kota::observe(KotaObserver::class);
        Kecamatan::observe(KecamatanObserver::class);
        Kelurahan::observe(KelurahanObserver::class);
    }
}
