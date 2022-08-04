<?php

namespace App\Listeners;

use App\Models\Cargo;
use App\Tenant\Events\TenantCreated;
use Couchbase\Role;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddCargoTenant
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(TenantCreated $event)
    {
        $user = $event->user();
        //$tenant = $event->tenant();

        if (!$cargo = Cargo::first())
            return;

        $user->cargos()->attach($cargo);
        return 1;
    }
}
