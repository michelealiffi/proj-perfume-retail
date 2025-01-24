<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('perfumes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->string('category');
            $table->string('subcategory');
            $table->json('notes');
            $table->decimal('price', 8, 2);
            $table->text('description');
            $table->string('size');
            $table->string('image');
            $table->json('ingredients');
            $table->integer('quantity');
            $table->string('gender');
            $table->boolean('limited_edition');
            $table->boolean('vegan');
            $table->boolean('natural');
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfumes');
    }
};
