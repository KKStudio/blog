<?php namespace Kkstudio\Blog;

class Blog extends \App\Module {

	protected $repo;

	public function __construct() 
	{
		$this->repo = new Repositories\BlogRepository;
	}

	public function posts(BlogRepository $repo) 
	{
		$posts = $this->repo->posts();

		return $posts;
	}

	public function post($slug, BlogRepository $repo) 
	{
		$post = $this->repo->post($slug);

		return $post;
	}
	
}