<?php namespace Mobytes\Htmlext;

use Illuminate\Support\ServiceProvider;

class HtmlextServiceProvider extends ServiceProvider {

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
		$this->package('mobytes/htmlext');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerTableBuilder();
	}

	/**
	 * Register the HTML builder instance.
	 *
	 * @return void
	 */
	protected function registerTableBuilder()
	{
		$this->app->bindShared('html', function($app)
		{
			return new TableBuilder($app['html']);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('htmlext');
	}

}
