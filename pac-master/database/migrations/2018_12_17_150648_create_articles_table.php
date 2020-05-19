<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('owner_id');
            $table->string('title');
            $table->text('description');
            $table->date('earliest_date');
            $table->date('latest_date');
            $table->jsonb('image_file_names');
            $table->text('physical_description')->nullable();
            $table->text('designer')->nullable();
            $table->text('origin')->nullable();
            $table->text('materials')->nullable();
            $table->text('techniques')->nullable();
            $table->text('decorations')->nullable();
            $table->text('search_words')->nullable();
            $table->jsonb('sewing_methods')->nullable();
            $table->jsonb('classification')->nullable();
            $table->jsonb('cut')->nullable();
            $table->jsonb('fastenings')->nullable();
            $table->jsonb('stiffening')->nullable();
            $table->jsonb('condition')->nullable();
            $table->jsonb('measurements')->nullable();
            $table->text('alterations')->nullable();
            $table->text('provenance')->nullable();
            $table->string('consent');
            $table->timestamps();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article');
    }
}
