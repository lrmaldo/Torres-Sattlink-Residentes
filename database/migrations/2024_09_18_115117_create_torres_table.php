<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTorresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('torres', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('longitud')->nullable();
            $table->string('latitud')->nullable();
            $table->text('comentarios')->nullable();
            $table->boolean('estado')->default(1);//activo, desactivado, mantenimiento
            /* direccion */
            $table->text('direccion')->nullable();
            $table->text('img_url')->nullable();
            /* altura */
            $table->string('altura')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('torres');
    }
}
