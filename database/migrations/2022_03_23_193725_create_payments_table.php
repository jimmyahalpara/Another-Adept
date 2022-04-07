<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table -> integer('amount');
            $table -> string('transaction_id') -> nullable();
            
            $table -> tinyInteger('status') -> default(0) -> comment('0: pending, 1: paid'); 
            $table -> bigInteger('user_id');
            $table -> bigInteger('invoice_id') -> nullable();  
            $table->timestamps();
            $table -> softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
