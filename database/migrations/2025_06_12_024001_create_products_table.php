<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('amount', 12, 2);
            $table->enum('type', ['income', 'expense']);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->date('date');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

