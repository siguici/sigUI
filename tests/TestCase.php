<?php

namespace Sigui\UI\Tests;

use Illuminate\Contracts\Config\Repository;
use Livewire\Livewire;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Sigui\UI\Facade;
use Sigui\UI\ServiceProvider;
use Spatie\LaravelRay\RayServiceProvider;

abstract class TestCase extends BaseTestCase
{
    use InteractsWithComponents;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        // Code before application created.

        parent::setUp();

        $this->artisan('optimize:clear');
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array<int,class-string<\Illuminate\Support\ServiceProvider>>
     */
    protected function getPackageProviders($app): array
    {
        return [
            LivewireServiceProvider::class,
            ServiceProvider::class,
            RayServiceProvider::class,
        ];
    }

    /**
     * Override application aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array<string, class-string<\Illuminate\Support\Facades\Facade>>
     */
    protected function getPackageAliases($app): array
    {
        return [
            'Livewire' => Livewire::class,
            'UI' => Facade::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function defineEnvironment($app)
    {
        tap($app->make('config'), function (Repository $config) {
            $config->set('app.debug', false);
            $config->set('database.default', 'testbench');
            $config->set('database.connections.testbench', [
                'driver' => 'sqlite',
                'database' => ':memory:',
                'prefix' => '',
            ]);
        });
    }

    /**
     * Define routes setup.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    protected function defineRoutes($router)
    {
        // Define routes.
    }
}
