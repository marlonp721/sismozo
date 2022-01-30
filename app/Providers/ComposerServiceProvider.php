<?php

namespace App\Providers;
 
class ComposerServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            ['layouts.admin.sidebar'], 'App\Http\ViewComposers\MenuComposer'
        );

        //default.filter
        view()->composer([
                'Ubigeo::filter_ubigeo',
                'Ubigeo::filter_accesspoint',
                'Ubigeo::filter_wifi_graphic',
                'Ubigeo::filter_wificonnected',
                'Ubigeo::filter_ubigeo_month',
                'Ubigeo::filter_wirelessclientsession',
                'Ubigeo::filter_appap'
            ],  'App\Http\ViewComposers\DefaultFormsFilterComposer'
        );

        view()->composer(
            [   
                'Configuration::default.partials.inspector-responsible.create-inspector',
                'Configuration::default.partials.inspector-responsible.edit-inspector'
            ], 'App\Http\ViewComposers\DefaultFormsFilterComposerA'
        );
    }

    public function register() {
        // Do nothing because of X and Y.
    }

}
