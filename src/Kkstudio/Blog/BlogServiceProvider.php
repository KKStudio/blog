<?php namespace Kkstudio\Blog;

use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider {

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
		$this->package('kkstudio/blog');

		\Route::get('blog', '\Kkstudio\Blog\Controllers\BlogController@index');
		\Route::get('blog/{slug}', '\Kkstudio\Blog\Controllers\BlogController@show');

		\Route::group([ 'prefix' => 'admin', 'before' => 'admin'], function() {

			\Route::get('blog', '\Kkstudio\Blog\Controllers\BlogController@admin');

			\Route::get('blog/create', '\Kkstudio\Blog\Controllers\BlogController@create');
			\Route::post('blog/create', '\Kkstudio\Blog\Controllers\BlogController@postCreate');

			\Route::get('blog/{slug}/edit', '\Kkstudio\Blog\Controllers\BlogController@edit');
			\Route::post('blog/{slug}/edit', '\Kkstudio\Blog\Controllers\BlogController@postEdit');

			\Route::get('blog/{slug}/delete', '\Kkstudio\Blog\Controllers\BlogController@delete');
			\Route::post('blog/{slug}/delete', '\Kkstudio\Blog\Controllers\BlogController@postDelete');
			

		});
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
