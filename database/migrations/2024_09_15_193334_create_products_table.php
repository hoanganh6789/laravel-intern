<?php

use App\Models\Category;
use App\Models\SubCategory;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->constrained();
            $table->foreignIdFor(SubCategory::class)->constrained();

            $table->string('name', 255);
            $table->string('slug', 190)->unique()->nullable();
            $table->string('sku', 190)->unique();
            $table->string('thumb_image', length: 500)->nullable();
            $table->double('price_regular');
            $table->double('price_sale')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_hot_deal')->default(true);
            $table->boolean('is_good_deal')->default(true);
            $table->boolean('is_new')->default(true);
            $table->boolean('is_show_home')->default(true);

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
