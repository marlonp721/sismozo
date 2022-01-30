<?php

namespace App\Extensions\EntrustFix;

use Zizaco\Entrust\EntrustServiceProvider;

class EntrustFixServiceProvider extends EntrustServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config files
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('entrust.php'),
        ]);
        // Register commands
        $this->commands('command.entrust.migration');
        // Register blade directives
        $this->bladeDirectivesFixed();
    }
    
    /**
     * Register the blade directives
     *
     * @return void
     */
    private function bladeDirectivesFixed()
    {
        // Call to Entrust::hasRole
        \Blade::directive('role', function ($expression) {
            return "<?php if (\\Entrust::hasRole({$expression})) : ?>";
        });
        \Blade::directive('endrole', function ($expression) {
            return "<?php endif; // Entrust::hasRole ?>";
        });
        // Call to Entrust::can
        \Blade::directive('permission', function ($expression) {

            return "<?php if (\\Entrust::can({$expression}) || \\Entrust::hasRole('superuser')) : ?>";
        });
        \Blade::directive('endpermission', function ($expression) {
            return "<?php endif; // Entrust::can ?>";
        });
        // Call to Entrust::ability
        \Blade::directive('ability', function ($expression) {
            return "<?php if (\\Entrust::ability({$expression})) : ?>";
        });
        \Blade::directive('endability', function ($expression) {
            return "<?php endif; // Entrust::ability ?>";
        });
    }
}
