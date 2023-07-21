<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.w
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            // $table->foreignId('category_id')->constrained();
            $table->string('title');
            $table->text('paragraph');
            $table->string('image')->nullable();
            $table->double('price');
            $table->double('rating')->nullable();
            $table->bigInteger('reads')->unsigned()->default(1)->index();
            $table->string('address');
            $table->boolean('is_salled')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
