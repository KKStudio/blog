<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KkstudioCreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kkstudio_blog_posts', function($table) {

			$table->increments('id');
			$table->string('title');
			$table->string('slug');
			$table->text('content')->nullable();
			$table->text('tags')->nullable();
			$table->timestamp('published')->nullable();
			$table->string('image')->nullable();
			$table->integer('category_id')->nullable();
			$table->nullableTimestamps();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('kkstudio_blog_posts');
	}

}
