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
			$table->text('content');
			$table->text('tags');
			$table->timestamp('published');
			$table->string('image');
			$table->integer('category_id');
			$table->timestamps();

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
