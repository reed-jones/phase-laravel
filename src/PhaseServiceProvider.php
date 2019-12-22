<?php

namespace ReedJones\Phase;

use Exception;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use ReedJones\Phase\Commands\GeneratePhaseRouter;
use ReedJones\Phase\Factories\PhaseFactory;
use ReedJones\Phase\Facades\Phase;

class PhaseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // php artisan vendor:publish --provider="ReedJones\Phase\PhaseServiceProvider" --tag="config"
        $this->publishes([__DIR__ . '/config.stub.php' => config_path('phase.php')], 'config');

        // Route macros Route::phase('/test', 'TestController@testing')
        $this->setMacros();

        // Hidden Route generation command
        $this->registerCommands();

        // register custom blade namepsace
        view()->addNamespace('phase', base_path('vendor/reed-jones/phase/src/views'));

        // Bind facade
        App::bind(PhaseFactory::class, function () {
            return new PhaseFactory;
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config.stub.php', 'phase');
    }

    /**
     * Sets up the Route::phase macro
     *
     * @return void
     */
    public function setMacros()
    {
        Route::macro('phase', function (...$args) {
            $route = Route::get(...$args);

            $controller = $route->action['controller'] ?? null;

            // make sure its not a closure
            // & make sure its controller@method
            if (is_string($controller) && Str::is('*@*', $controller)) {
                Phase::addRoute($route->uri, $route->action);
            } else {
                throw new Exception("Route::phase is not compatible with closures.\n"
                    . "Please use the controller@method syntax.\n"
                    . "Failed on '{$route->uri}' route.");
            }

            return $route;
        });
    }

    /**
     * Registers route generation cli command
     *
     * @return void
     */
    public function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([ GeneratePhaseRouter::class ]);
        }
    }
}
