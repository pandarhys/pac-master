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
            $table->text('physical_description');
            $table->text('designer');
            $table->text('origin');
            $table->text('materials');
            $table->text('techniques');
            $table->text('decorations');
            $table->text('search_words');
            $table->text('sewing_methods');
            $table->text('classification');
            $table->text('cut');
            $table->text('fastenings');
            $table->text('stiffening');
            $table->text('condition');
            $table->jsonb('measurements');
            $table->text('alterations');
            $table->text('provenance');
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
