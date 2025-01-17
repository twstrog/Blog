<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('category_id');
            $table->string('name', 255);
            $table->string('slug', 255)->nullable();
            $table->text('description', 20000);
            $table->string('yt_iframe', 255)->nullable();
            $table->string('meta_title', 65);
            $table->string('meta_description', 165);
            $table->string('meta_keyword', 105);

            $table->tinyInteger('status')->default('0');
            $table->integer('created_by');

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
        Schema::dropIfExists('posts');
    }
}
