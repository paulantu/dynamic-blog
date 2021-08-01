<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cat_id')->constrained('categories', 'id');
            $table->foreignId('sub_cat_id')->nullable()->constrained('sub_categories', 'id');
            $table->string('created_by');
            $table->string('title');
            $table->string('meta_title');
            $table->string('slug');
            $table->longText('description');
            $table->text('summary')->nullable();
            $table->string('images')->nullable();
            $table->string('status')->default(0);
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('blog_posts');
    }
}
