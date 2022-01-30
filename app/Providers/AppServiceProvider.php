<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
use App\Modules\Ir21\Entities\CronTask;
use App\Modules\Security\Entities\Event_Logs;
use App\Modules\Ir21\Entities\Ir21_Documents;
use App\Modules\Roaming\Entities\RoamingAgreement;
use App\Modules\Security\Entities\Params;
use App\Modules\Security\Entities\User;
use Illuminate\Support\ServiceProvider;
use App\Modules\Security\Entities\Role;
use Validator;
use DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        if (env('REDIRECT_HTTPS')) {
            $url->formatScheme('https://');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (env('REDIRECT_HTTPS')) {
        $this->app['request']->server->set('HTTPS', true);
        }
        // Do nothing because of X and Y.
    }
}