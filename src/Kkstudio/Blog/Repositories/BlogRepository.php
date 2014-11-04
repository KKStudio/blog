<?php namespace Kkstudio\Blog\Repositories;

use Kkstudio\Blog\Models\Post as Post;
use Kkstudio\Blog\Models\Category as Category;
use Kkstudio\Blog\Models\Comment as Comment;

class BlogRepository {

	public function posts() 
	{
		$now = \Carbon\Carbon::now();

		$postPerPage = m('Blog')->setting('post-per-page', 10);
		if(!is_numeric($postPerPage)) return \App::abort(500);

		return Post::with('category')->where('published', '<=', $now->format('Y-m-d H:i:s'))->orderBy('published', 'desc')->paginate($postPerPage);
	}

	public function postsFromCategory($slug)
	{

		$category = Category::where('slug', $slug)->first();

		$now = \Carbon\Carbon::now();

		$postPerPage = m('Blog')->setting('post-per-page', 10);
		if(!is_numeric($postPerPage)) return \App::abort(500);

		return Post::where('category_id', $category->id)->where('published', '<=', $now->format('Y-m-d H:i:s'))->orderBy('published', 'desc')->paginate($postPerPage);
	
	}

	public function all($per_page) 
	{

		return Post::with('category')->orderBy('published', 'desc')->paginate($per_page);
	}

	public function post($slug)
	{
		$post = Post::with('category')->where('slug', $slug)->first();

		return $post;
	}

	public function create($slug, $title, $content, $tags, $image, $published, $category_id)
	{
		return Post::create([

			'slug' => $slug,
			'title' => $title,
			'content' => $content,
			'category_id' => $category_id,
			'tags' => $tags,
			'image' => $image,
			'published' => $published

		]);
	}

	public function categories() 
	{
		return Category::orderBy('position')->get();
	}

	public function category($slug) 
	{
		return Category::where('slug', $slug)->first();
	}

	public function categoryById($id) 
	{
		return Category::findOrFail($id);
	}

	public function categoryCreate($name, $slug)
	{

		$position = $this->max() + 1;

		return Category::create([

			'slug' => $slug,
			'name' => $name,
			'position' => $position

		]);

	}

	public function max() {

		$position = 0;

		$max = Category::orderBy('position', 'desc')->first();
		if($max) $position = $max->position;

		return $position;

	}

}