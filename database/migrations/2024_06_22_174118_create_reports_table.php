<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // Make user_id nullable
            $table->string('title');
            $table->string('tag');
            $table->boolean('anonymous');
            $table->boolean('public');
            $table->string('author');
            $table->text('description');
            $table->date('report_date');
            $table->string('photo');
            $table->integer('votes')->default(0);
            $table->string('status');
            $table->string('status_desc');
            $table->timestamps();

            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
