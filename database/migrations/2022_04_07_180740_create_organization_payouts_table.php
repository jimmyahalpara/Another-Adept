<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationPayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_payouts', function (Blueprint $table) {
            $table->id();

            $table -> bigInteger('organization_id') -> unsigned();
            $table -> bigInteger('amount') -> unsigned();
            $table -> bigInteger('status') -> unsigned() -> default(0) -> comment('0: pending, 1: paid');

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
        Schema::dropIfExists('organization_payouts');
    }
}
