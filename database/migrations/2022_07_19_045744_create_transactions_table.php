<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamp('transaction_date');
            $table->string('location');
            $table->integer('price');
            $table->string('image');
            $table->foreignId('building_type_id')->constrained();
            $table->foreignId('sales_type_id')->constrained();
            $table->foreignUuid('user_id')->constrained();
            $table->foreignUuid('property_id')->constrained();
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
        Schema::dropIfExists('transactions');
    }
}
