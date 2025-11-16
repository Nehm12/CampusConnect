<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Material;
use App\Policies\AnnouncementPolicy;
use App\Policies\AnnouncementCategoryPolicy;
use App\Policies\ReservationPolicy;
use App\Policies\RoomPolicy;
use App\Policies\MaterialPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Announcement::class => AnnouncementPolicy::class,
        AnnouncementCategory::class => AnnouncementCategoryPolicy::class,
        Reservation::class => ReservationPolicy::class,
        Room::class => RoomPolicy::class,
        Material::class => MaterialPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
?>