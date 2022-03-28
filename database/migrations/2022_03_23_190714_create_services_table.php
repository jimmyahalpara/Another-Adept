<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table -> string('name');
            $table -> text('description');
            $table -> bigInteger('price');
            $table -> bigInteger('price_type_id');
            // $table -> bigInteger('area_id');
            $table -> bigInteger('organization_id');
            $table -> bigInteger('service_category_id') -> nullable();

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
        Schema::dropIfExists('services');
    }
}
