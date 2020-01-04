<?php

namespace ReedJones\Phase\Tests;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            'ReedJones\Vuexcellent\VuexcellentServiceProvider',
            'ReedJones\Phase\PhaseServiceProvider',
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Vuex' => 'ReedJones\Vuexcellent\Facades\Vuex',
            'Phase' => 'ReedJones\Phase\Facades\Phase',
        ];
    }

    public function setUp(): void
    {
        parent::setUp();
        Route::group([
            'namespace' => 'ReedJones\Phase\Tests\Controllers',
            'middleware' => [], ], function () {
                Route::phase('/', 'TestController@HelloWorld');
            });
        View::addLocation(__DIR__.'/views');
    }
}
