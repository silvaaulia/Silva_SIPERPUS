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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->year('year');
            $table->string('city');
            $table->string('publisher');
            $table->string('cover');
            $table->unsignedBigInteger('bookshelf_id');
            $table->unsignedBigInteger('categoty_id');
            $table->timestamps();

            $table->foreign('bookshelf_id')
            ->references('id')->on('bookshelves')
            ->onUpdate('cascade')
            ->onDelte('cascade');


            $table->foreign('categoty_id')
            ->references('id')->on('categories')
            ->onUpdate('cascade')
            ->onDelte('cascade');

            ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
