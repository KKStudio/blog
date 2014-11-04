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
		\Route::get('blog/category/{slug}', '\Kkstudio\Blog\Controllers\BlogController@fromCategory');
		\Route::get('blog/{slug}', '\Kkstudio\Blog\Controllers\BlogController@show');

		\Route::group([ 'prefix' => 'admin', 'before' => 'admin'], function() {

			\Route::get('blog', '\Kkstudio\Blog\Controllers\BlogController@admin');

			\Route::get('blog/create', '\Kkstudio\Blog\Controllers\BlogController@create');
			\Route::post('blog/create', '\Kkstudio\Blog\Controllers\BlogController@postCreate');

			\Route::get('blog/{slug}/edit', '\Kkstudio\Blog\Controllers\BlogController@edit');
			\Route::post('blog/{slug}/edit', '\Kkstudio\Blog\Controllers\BlogController@postEdit');

			\Route::get('blog/{slug}/delete', '\Kkstudio\Blog\Controllers\BlogController@delete');
			\Route::post('blog/{slug}/delete', '\Kkstudio\Blog\Controllers\BlogController@postDelete');
				
			// Categories

			\Route::get('blog/categories', '\Kkstudio\Blog\Controllers\BlogController@categories');
			\Route::get('blog/categories/create', '\Kkstudio\Blog\Controllers\BlogController@category_create');
			\Route::post('blog/categories/create', '\Kkstudio\Blog\Controllers\BlogController@category_postCreate');

			\Route::get('blog/categories/{slug}/edit', '\Kkstudio\Blog\Controllers\BlogController@category_edit');
			\Route::post('blog/categories/{slug}/edit', '\Kkstudio\Blog\Controllers\BlogController@category_postEdit');

			\Route::get('blog/categories/{slug}/delete', '\Kkstudio\Blog\Controllers\BlogController@category_delete');
			\Route::post('blog/categories/{slug}/delete', '\Kkstudio\Blog\Controllers\BlogController@category_postDelete');
			
			\Route::post('blog/categories/swap', '\Kkstudio\Blog\Controllers\BlogController@category_swap');


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
