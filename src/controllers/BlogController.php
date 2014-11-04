<?php namespace Kkstudio\Blog\Controllers;

use Illuminate\Routing\Controller;
use Kkstudio\Blog\Repositories\BlogRepository;

class BlogController extends Controller {

	protected $repo;

	public function __construct(BlogRepository $repo) 
	{
		if(! m('Blog')->enabled()) return \App::abort('404');
		$this->repo = $repo;
	}

	public function index()
	{
		$posts = $this->repo->posts();

		return v('blog.index', [ 'posts' => $posts ]);
	}

	public function show($slug)
	{
		$post = $this->repo->post($slug);

		if(!$post) return \Redirect::to('/');

		return v('blog.show', [ 'post' => $post ]);
	}

	public function fromCategory($slug)
	{
		$posts = $this->repo->postsFromCategory($slug);

		return v('blog.index', [ 'posts' => $posts, 'currentCategory' => $slug ]);

	}

	// Administration

	public function admin()
	{
		$posts = $this->repo->all(20);

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
		$category_id = \Request::get('category_id');
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

		$post = $this->repo->create($slug, $title, $content, $tags, $image, $published, $category_id);

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
		$category_id = \Request::get('category_id');
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
		$post->category_id = $category_id;	
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

	// Categories

	public function categories()
	{
		$categories = $this->repo->categories();

		return \View::make('blog::categories')->with('categories', $categories);
	}

	public function category_create() 
	{
		return \View::make('blog::category_create');
	}

	public function category_postCreate() 
	{
		if(! \Request::get('name')) {

			\Flash::error('Musisz podać nazwę.');

			return \Redirect::back()->withInput();

		}

		$name = \Request::get('name');
		$slug = \Str::slug($name);

		$exists = $this->repo->category($slug);

		if($exists) {

			\Flash::error('Kategoria z tą nazwą już istnieje.');

			return \Redirect::back()->withInput();

		}

		$this->repo->categoryCreate($name, $slug);

		\Flash::success('Kategoria dodana pomyślnie.');

		return \Redirect::to('admin/blog/categories');
	}

	public function category_edit($slug) 
	{
		$item = $this->repo->category($slug);

		return \View::make('blog::category')->with('category', $item);
	}

	public function category_postEdit($slug) 
	{
		$item = $this->repo->category($slug);

		if(! \Request::get('name')) {

			\Flash::error('Musisz podać nazwę.');

			return \Redirect::back()->withInput();

		}

		$name = \Request::get('name');
		$slug = \Str::slug($name);

		$exists = $this->repo->category($slug);

		if($exists && $exists->id != $item->id) {

			\Flash::error('Kategoria z tą nazwą już istnieje.');

			return \Redirect::back()->withInput();

		}

		$item->name = $name;
		$item->slug = $slug;

		$item->save();	

		\Flash::success('Kategoria edytowana pomyślnie.');

		return \Redirect::back();

	}

	public function category_delete($slug) 
	{
		$item = $this->repo->category($slug);

		return \View::make('blog::category_delete')->with('category', $item);
	}

	public function category_postDelete($slug) 
	{
		$item = $this->repo->category($slug);
		$item->delete();

		\Flash::success('Kategoria została usunięta.');

		return \Redirect::to('admin/blog/categories');
	}

	public function category_swap() {

		$id1 = \Request::get('id1');
		$id2 = \Request::get('id2');

		$first = $this->repo->categoryById($id1);
		$second = $this->repo->categoryById($id2);

		$first->moveAfter($second);

		\Flash::success('Posortowano.');

		return \Redirect::back();

	}

}