<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Page' => 'App\Policies\PagePolicy',
        'App\Models\User' => 'App\Policies\ManageUsersPolicy',
        'App\Models\Post' => 'App\Policies\PostPolicy',
        'App\Models\Slider' => 'App\Policies\SliderPolicy',
        'App\Models\Event' => 'App\Policies\EventPolicy',
        'App\Models\Gallery' => 'App\Policies\GalleryPolicy',
        'App\Models\GalleryImage' => 'App\Policies\GalleryImagePolicy',
        'App\Models\ContactUs' => 'App\Policies\ContactUsPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
