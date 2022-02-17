<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('category_id');
            $table->string('title'); // Название новости
            $table->text('text'); // Текст новости
            $table->dateTime('datetime_post')->index(); // Дата и время публикации на сайте
            $table->boolean('is_posted')->index(); // Выводить ли новость на сайте
            $table->timestamps();

            // Внешний ключ
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
