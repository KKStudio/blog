<?php namespace Kkstudio\Blog;

class Blog extends \App\Module {

	protected $repo;

	public function __construct() 
	{
		$this->repo = new Repositories\BlogRepository;
	}

	public function posts() 
	{
		$posts = $this->repo->posts();

		return $posts;
	}

	public function post($slug) 
	{
		$post = $this->repo->post($slug);

		return $post;
	}

	public function categories() 
	{
		$categories = $this->repo->categories();

		return $categories;
	}

	public function categoriesArray() 
	{
		$categories = $this->repo->categories();

		$categories_arr = [ '0' => 'Brak' ];

		foreach ($categories as $key => $category) {
			$categories_arr[$category->id] = $category->name;
		}
	}
	
}