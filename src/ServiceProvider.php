<?php namespace Lowerends\SecurityChecker;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['command.security-checker.check'] = $this->app->share(
            function ($app) {
                return new Console\CheckCommand($app['security-checker']);
            }
        );
        $this->commands(['command.security-checker.check']);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['security-checker', 'command.security-checker.check'];
    }
}
