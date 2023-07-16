<?php

namespace Sikessem\UI\Core;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Support\Str;
use Illuminate\View\Compilers\BladeCompiler;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap UI services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
        $this->registerServices();
    }

    /**
     * Register Ui services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerViews();
        $this->registerNamespaces();
        $this->registerComponents();
        $this->registerPublishables();
    }

    protected function registerServices(): void
    {
        $this->app->singleton(Manager::class);
        $this->app->instance('ui.path', sikessem_ui_path());
        $this->app->alias(Manager::class, 'sikessem.ui');
    }

    protected function registerConfig(): void
    {
        $this->mergeConfigFrom(sikessem_ui_path('config/sikessem-ui.php'), 'ui');
    }

    protected function registerTranslations(): void
    {
        $this->loadTranslationsFrom(sikessem_ui_path('res/langs'), 'ui');
    }

    protected function registerViews(): void
    {
        $this->loadViewsFrom(sikessem_ui_path('res/views'), 'ui');
    }

    protected function registerNamespaces(): void
    {
        Blade::componentNamespace(Manager::COMPONENT_NAMESPACE, 'ui');
        Blade::anonymousComponentNamespace(Manager::ANONYMOUS_COMPONENT_NAMESPACE, 'ui');
    }

    protected function registerComponents(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponentPath(sikessem_ui_path('src/Components'));
            $this->registerComponentPath(sikessem_ui_path('res/views/components'), anonymous: true);
        });
    }

    protected function registerPublishables(): void
    {
        $this->publishesToGroups([
            sikessem_ui_path('config/sikessem-ui.php') => config_path('sikessem-ui.php'),
        ], ['sikessem', 'ui:config']);

        $this->publishesToGroups([
            sikessem_ui_path('res/langs') => lang_path(),
        ], ['sikessem', 'ui:langs']);

        $this->publishesToGroups([
            sikessem_ui_path('res/views') => resource_path('views/ui'),
        ], ['sikessem', 'ui:views']);
    }

    /**
     * @param  string[]|null  $groups
     */
    protected function publishesToGroups(array $paths, array $groups = null): void
    {
        if (is_null($groups)) {
            $this->publishes($paths);

            return;
        }

        foreach ((array) $groups as $group) {
            $this->publishes($paths, $group);
        }
    }

    protected function registerComponentPath(string $path, string $base = '', bool $anonymous = false): void
    {
        if (file_exists($path)) {
            is_dir($path) ?
            $this->registerComponentDirectory($path, $base, $anonymous) :
            $this->registerComponentFile($path, $base, $anonymous);
        }
    }

    protected function registerComponentDirectory(string $directory, string $base = '', bool $anonymous = false): void
    {
        if ($files = scandir($directory)) {
            $separator = $anonymous ? '.' : '\\';
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $path = "$directory/$file";
                    $this->registerComponentPath($path, is_dir($path) ? "{$base}$separator{$file}" : $base, $anonymous);
                }
            }
        }
    }

    protected function registerComponentFile(string $file, string $base, bool $anonymous = false): void
    {
        if (($anonymous && Str::of($file)->is('*.blade.php')) || (! $anonymous && Str::of($file)->is('*.php'))) {
            $component = basename($file, $anonymous ? '.blade.php' : '.php');
            $separator = $anonymous ? '.' : '\\';
            $base = Str::of($base)->trim($separator);
            if (! $component || $component === 'index') {
                $component = $base;
            } else {
                $component = Str::of("{$base}$separator{$component}")->trim($separator);
            }
            Facade::component($component->toString(), anonymous: $anonymous);
        }
    }
}
