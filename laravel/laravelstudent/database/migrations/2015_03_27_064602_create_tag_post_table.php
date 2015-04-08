<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagPostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tag_post', function(Blueprint $table)
		{
			$table->integer('tag_id')->unsigned();
			$table->integer('post_id')->unsigned();
			$table->unique(['post_id', 'tag_id']);  // 1 2
			$table->foreign('post_id')->references('id')->on('posts')->onDelete('CASCADE');
			$table->foreign('tag_id')->references('id')->on('tags')->onDelete('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tag_post');
	}

}
