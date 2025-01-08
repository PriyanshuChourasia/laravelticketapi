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
        Schema::create('items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('cost');
            $table->string('qtn')->comment('quantity')->default('1');
            $table->foreignUuid('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignUuid('item_group_id')->references('id')->on('item_groups')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignUuid('item_unit_id')->nullable()->references('id')->on('item_units')->onUpdate('cascade')->nullOnUpdate()->onDelete('cascade')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
