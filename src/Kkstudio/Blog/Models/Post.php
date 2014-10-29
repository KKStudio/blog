<?php namespace Kkstudio\Blog\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Post extends Eloquent {

	protected $table = 'kkstudio_blog_posts';

	protected $guarded = [ 'id' ];

	public function getThumb() {

		$path = public_path('assets/blog/thumb_' . $this->image);

		if(is_readable($path)) return asset('assets/blog/thumb_' . $this->image);

		return  asset('assets/blog/thumb_default.png');

	}

	public function getImage() {

		$path = public_path('assets/blog/' . $this->image);

		if(is_readable($path)) return asset('assets/blog/' . $this->image);

		return  asset('assets/blog/default.png');

	}

}