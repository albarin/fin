<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_transaction', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('tag_id')->unsigned();
            $table->foreign('tag_id')->references('id')->on('tags');

            $table->integer('transaction_id')->unsigned();
            $table->foreign('transaction_id')->references('id')->on('transactions');

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
        Schema::dropIfExists('tag_transaction');
    }
}
