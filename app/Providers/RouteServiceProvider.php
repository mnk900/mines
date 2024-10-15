<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/login';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            foreach(\App\Models\Page::all() as $page){
                if($page->url=='/about'){
                  //  dd($page->url);
                    Route::view($page->url,'home.about',['page'=>$page]);
                }
                else if($page->url=='/food-sovereignty' || $page->url=='/land-reforms' || $page->url=='/climate-justice' || $page->url=='/fossil-fuels' ){
                    //  dd($page->url);
                      Route::view($page->url,'home.themes',['page'=>$page]);
                  }
                  else if($page->url=='/events'){
                    //  dd($page->url);
                      Route::view($page->url,'home.events',['page'=>$page]);
                  }
                  else if($page->url=='/gallery'){
                      //dd($page->url);
                      Route::view($page->url,'home.gallery',['page'=>$page]);
                  }
                  else if($page->url=='/contact'){
                    //dd($page->url);
                    Route::view($page->url,'home.contact',['page'=>$page]);
                }
                else{
                Route::view($page->url,'home.page',['page'=>$page]);
                }
            }
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
