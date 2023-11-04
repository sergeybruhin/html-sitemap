<?php

namespace SergeyBruhin\HtmlSitemap\Providers;

use Illuminate\Support\ServiceProvider;
use SergeyBruhin\HtmlSitemap\HtmlSitemap;

final class HtmlSitemapServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'html-sitemap');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'html-sitemap');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/config.php' => config_path('html-sitemap.php'),
            ], 'config');

            // Publishing the views.
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/html-sitemap'),
            ], 'views');

            // Publishing assets.
            $this->publishes([
                __DIR__ . '/../../resources/css' => public_path('vendor/html-sitemap/css'),
            ], 'assets');

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/html-sitemap'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);


        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'html-sitemap');

        // Register the main class to use with the facade
        $this->app->singleton('html-sitemap', function () {
            return new HtmlSitemap;
        });

    }
}
