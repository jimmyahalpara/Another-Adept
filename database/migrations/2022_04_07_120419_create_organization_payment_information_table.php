<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationPaymentInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_payment_information', function (Blueprint $table) {
            $table->id();

            $table -> string('bank_name') -> nullable();
            $table -> string('bank_account_number') -> nullable();
            $table -> string('ifsc') -> nullable();
            $table -> string('upi_id') -> nullable();
            $table -> unsignedBigInteger('organization_id');

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
        Schema::dropIfExists('organization_payment_information');
    }
}
