<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDialogMassagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dialog_messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('dialog_id')->unsigned();
            $table->string('text');
            $table->string('file')->nullable(true);
            $table->integer('sender_id');
            $table->foreign('dialog_id')
                ->references('id')
                ->on('dialogs')
                ->onDelete('cascade');
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
        Schema::dropIfExists('dialog_massages');
    }
}
