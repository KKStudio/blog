<?php namespace Kkstudio\Blog\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Comment extends Eloquent {

	protected $table = 'kkstudio_blog_comments';

	protected $guarded = [ 'id' ];

}