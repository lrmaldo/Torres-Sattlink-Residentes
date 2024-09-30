<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispositivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispositivos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo')->nullable();
            $table->string('hostname')->nullable();
            $table->string('ip')->nullable();
            $table->string('usuario')->nullable();
            $table->string('password')->nullable();
            $table->string('ssid')->nullable();
            $table->string('numero_de_cliente')->nullable();
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->text('img_url')->nullable();
            $table->text('comentario')->nullable();
            $table->foreignId('torre_id')->nullable()->references('id')->on('torres')
            ->onDelete('cascade')
            ->onUpdate('cascade');
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
        Schema::dropIfExists('dispositivos');
    }
}
