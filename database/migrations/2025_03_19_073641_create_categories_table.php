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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('status')->default(1); // 1-enabled, 2-disabled
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();

        //$table->foreign('parent_id')	Defines parent_id as a foreign key in the categories table.
        // ->references('id')	Specifies that parent_id refers to the id column in the same table (categories).
        // ->on('categories')	States that parent_id is referencing the id column inside the categories table`.
        // ->onDelete('cascade')If a parent category is deleted, all child categories automatically update their parent_id to NULL or get deleted on your logic.

            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};