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
	
}