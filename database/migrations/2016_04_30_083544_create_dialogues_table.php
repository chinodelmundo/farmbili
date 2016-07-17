<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDialoguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dialogues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transaction_id');
            $table->integer('user_id');
            $table->integer('quantity');
            $table->decimal('total_price');
            $table->string('comment');
            $table->integer('buyer_approved');
            $table->integer('retailer_approved');
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
        Schema::drop('dialogues');
    }
}
