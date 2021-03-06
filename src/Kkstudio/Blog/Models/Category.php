<?php namespace Kkstudio\Blog\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Http\Traits\Sortable as SortableTrait;

class Category extends Eloquent {

	use SortableTrait;

	protected $table = 'kkstudio_blog_categories';

	protected $guarded = [ 'id' ];

	public function posts()
	{
		return $this->hasMany('\Kkstudio\Blog\Models\Post', 'category_id', 'id');
	}

}