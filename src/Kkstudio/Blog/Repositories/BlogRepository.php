<?php namespace Kkstudio\Blog\Repositories;

use Kkstudio\Blog\Models\Post as Post;
use Kkstudio\Blog\Models\Category as Category;
use Kkstudio\Blog\Models\Comment as Comment;

class BlogRepository {

	public function posts() 
	{
		$now = \Carbon\Carbon::now();

		return Post::all();

		return Post::where('published', '<=', $now->format('Y-m-d H:i:s'))->orderBy('published', 'desc')->paginate(10)->get();
	}

	public function post($slug)
	{
		$post = Post::where('slug', $slug)->first();

		return $post;
	}

	public function create($slug, $name, $content, $tags, $image, $published)
	{
		return Post::create([

			'slug' => $slug,
			'name' => $name,
			'content' => $content,
			'tags' => $tags,
			'image' => $image,
			'published' => $published

		]);
	}

}