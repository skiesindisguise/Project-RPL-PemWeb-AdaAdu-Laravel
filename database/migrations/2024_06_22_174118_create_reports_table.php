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
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); //FK ke user
            $table->string('title');
            $table->string('tag');
            $table->boolean('anonymous');
            $table->boolean('public');
            $table->text('description');
            $table->string('author');
            $table->date('report_date');
            $table->string('status')->default('Belum Ditindaklanjuti');
            $table->string('status_desc')->nullable();
            $table->string('photo')->nullable();
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