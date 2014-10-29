<?php namespace Kkstudio\Blog;

use Repositories\BlogRepository;

class Blog extends \App\Module {

	public function posts(BlogRepository $repo) 
	{
		$posts = $repo->posts();

		return $posts;
	}

	public function post($slug, BlogRepository $repo) 
	{
		$post = $repo->post($slug);

		return $post;
	}
	
}