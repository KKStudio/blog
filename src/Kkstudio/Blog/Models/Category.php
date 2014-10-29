<?php namespace Kkstudio\Blog\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Category extends Eloquent {

	protected $table = 'kkstudio_blog_categories';

	protected $guarded = [ 'id' ];

}