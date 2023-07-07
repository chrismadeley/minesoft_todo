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
        Schema::create('todo_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('todo_list_id')->nullable();
            $table->string('name');
            $table->boolean('completed')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            $table->foreign('todo_list_id')->references('id')->on('todo_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('todo_items', function (Blueprint $table) {
            $table->dropForeign(['todo_list_id']);
        });

        Schema::dropIfExists('todo_items');
    }
};