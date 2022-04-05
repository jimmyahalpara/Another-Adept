<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table -> timestamp('due') -> nullable();
            $table -> unsignedBigInteger('user_id') -> nullable();
            $table -> unsignedBigInteger('service_order_id') -> nullable();
            $table -> unsignedBigInteger('amount') -> nullable();
            $table -> text('description') -> nullable();
            $table -> integer('invoice_state_id') -> default(1) -> comment('0 => Unpaid, 1 => paid');
            


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
        Schema::dropIfExists('invoices');
    }
}
