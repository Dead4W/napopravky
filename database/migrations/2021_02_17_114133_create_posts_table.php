<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         * tags table
         */
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
        });

        /*
         * posts table
         */
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('text');
            $table->string('author');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        /*
         * schema table for relationship with posts and tags
         * many to many
         */
        Schema::create('posts_tags', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('tag_id')->unsigned();
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')->onDelete('cascade');

            $table->bigInteger('post_id')->unsigned();
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts_tags');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('posts');
    }
}
