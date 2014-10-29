<?php namespace Kkstudio\Blog\Controllers;

use Illuminate\Routing\Controller;
use Kkstudio\Blog\Repositories\BlogRepository;

class BlogController extends Controller {

	public function index()
	{
		$posts = m('Blog')->posts();

		return v('blog.index', [ 'posts' => $posts ]);
	}

	public function show($slug)
	{
		$post = m('Blog')->post($slug);

		if(!$post) return \Redirect::to('/');

		return v('blog.show', [ 'post' => $post ]);
	}

	// Administration

	public function admin()
	{
		$posts = m('Blog')->posts();

		return \View::make('blog::admin')->with('posts', $posts);
	}


	public function create() 
	{
		return \View::make('blog::create');
	}

	public function postCreate(BlogRepository $repo) 
	{
		if(! \Request::get('title')) {

			\Flash::error('Please provide a title.');

			return \Redirect::back()->withInput();

		}

		$title = \Request::get('title');
		$slug = \Carbon\Carbon::now()->format('Y-m') . '-' . \Str::random(6) . '-' . \Str::slug($title);
		$content = \Request::get('content');
		$tags = \Request::get('tags');
		$published = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
		$image = '';

		if(\Input::hasFile('image')) {

			$image_name = \Str::random(32) . \Str::random(32) . '.png';
			$image = \Image::make(\Input::file('image')->getRealPath());

            $image->save(public_path('assets/blog/' . $image_name));

            $callback = function ($constraint) { $constraint->upsize(); };
			$image->widen(320, $callback)->heighten(180, $callback);

            $image->save(public_path('assets/blog/thumb_' . $image_name));

            $image = $image_name;

		}

		$post = $repo->create($slug, $title, $content, $tags, $image, $published);

		\Flash::success('Post created successfully.');

		return \Redirect::to('admin/blog');

	}

	public function edit($slug, BlogRepository $repo) 
	{
		$post = $repo->post($slug);

		return \View::make('blog::edit')->with('post', $post);
	}

	public function postEdit($slug, BlogRepository $repo) 
	{
		$post = $repo->post($slug);

		if(! \Request::get('title')) {

			\Flash::error('Please provide a title.');

			return \Redirect::back()->withInput();

		}

		$title = \Request::get('title');
		$content = \Request::get('content');
		$tags = \Request::get('tags');

		if(\Input::hasFile('image')) {

			$image_name = \Str::random(32) . \Str::random(32) . '.png';
			$image = \Image::make(\Input::file('image')->getRealPath());

            $image->save(public_path('assets/blog/' . $image_name));

            $callback = function ($constraint) { $constraint->upsize(); };
			$image->widen(320, $callback)->heighten(180, $callback);

            $image->save(public_path('assets/blog/thumb_' . $image_name));

            $post->image = $image_name;

		}

		if($post->title != $title) {

			$slug = \Carbon\Carbon::now()->format('Y-m') . '-' . \Str::random(6) . '-' . \Str::slug($title);
		
			$post->title = $title;
			$post->slug = $slug;

		}

		$post->content = $content;	
		$post->tags = $tags;	

		$post->save();	

		\Flash::success('Post edited successfully.');

		return \Redirect::to('admin/blog/'.$slug.'/edit');

	}

	public function delete($slug, BlogRepository $repo) 
	{
		$post = $repo->post($slug);

		return \View::make('blog::delete')->with('post', $post);
	}

	public function postDelete($slug, BlogRepository $repo) 
	{
		$post = $repo->post($slug);
		$post->delete();

		\Flash::success('Post deleted.');

		return \Redirect::to('blog/portfolio');
	}

}