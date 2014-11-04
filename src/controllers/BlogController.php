<?php namespace Kkstudio\Blog\Controllers;

use Illuminate\Routing\Controller;
use Kkstudio\Blog\Repositories\BlogRepository;

class BlogController extends Controller {

	protected $repo;

	public function __construct(BlogRepository $repo) 
	{
		if(! m('Blog')->enabled()) return \Redirect::to('404');
		$this->repo = $repo;
	}

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

	public function postCreate() 
	{
		if(! \Request::get('title')) {

			\Flash::error('Musisz podać tytuł.');

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

		$post = $this->repo->create($slug, $title, $content, $tags, $image, $published);

		\Flash::success('Pomyślnie dodano post.');

		return \Redirect::to('admin/blog');

	}

	public function edit($slug) 
	{
		$post = $this->repo->post($slug);

		return \View::make('blog::edit')->with('post', $post);
	}

	public function postEdit($slug) 
	{
		$post = $this->repo->post($slug);

		if(! \Request::get('title')) {

			\Flash::error('Musisz podać tytuł.');

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

		\Flash::success('Pomyślnie edytowano post.');

		return \Redirect::to('admin/blog/'.$slug.'/edit');

	}

	public function delete($slug) 
	{
		$post = $this->repo->post($slug);

		return \View::make('blog::delete')->with('post', $post);
	}

	public function postDelete($slug) 
	{
		$post = $this->repo->post($slug);
		$post->delete();

		\Flash::success('Post usunięty.');

		return \Redirect::to('admin/blog');
	}

}