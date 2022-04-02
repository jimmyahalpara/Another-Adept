<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserServiceRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_service_ratings', function (Blueprint $table) {
            $table->id();

            $table -> unsignedBigInteger('user_id');
            $table -> unsignedBigInteger('service_id');
            $table -> text('feedback') -> nullable();
            $table -> unsignedInteger('rating');

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
        Schema::dropIfExists('user_service_ratings');
    }
}
