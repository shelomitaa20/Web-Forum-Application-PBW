<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id('id_post');
            $table->string('title')->nullable();
            $table->text('content');
            $table->unsignedBigInteger('parent')->nullable();
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('total_likes')->default(0); 
            $table->unsignedBigInteger('total_shares')->default(0); 
            $table->timestamps();

            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('parent')->references('id_post')->on('posts')->onDelete('cascade');
        });

        Schema::create('images', function (Blueprint $table) {
            $table->id('id_img');
            $table->string('url');
            $table->unsignedBigInteger('id_post');
            $table->timestamps();

            $table->foreign('id_post')->references('id_post')->on('posts')->onDelete('cascade');
        });

        Schema::create('likes', function (Blueprint $table) {
            $table->id('id_like');
            $table->unsignedBigInteger('id_post');
            $table->unsignedBigInteger('id'); // id dari tabel users
            $table->timestamps();

            $table->foreign('id_post')->references('id_post')->on('posts')->onDelete('cascade');
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('shares', function (Blueprint $table) {
            $table->id('id_share');
            $table->unsignedBigInteger('id_post');
            $table->unsignedBigInteger('id'); // id dari tabel users
            $table->timestamps();

            $table->foreign('id_post')->references('id_post')->on('posts')->onDelete('cascade');
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shares');
        Schema::dropIfExists('likes');
        Schema::dropIfExists('images');
        Schema::dropIfExists('posts');
    }
};
