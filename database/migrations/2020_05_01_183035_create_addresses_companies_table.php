<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses_companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('address_id');
            $table->unsignedBigInteger('company_id');
            $table->timestamps();

            $table->foreign('address_id')
                ->references('id')
                ->on('addresses')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gates');
    }
}
