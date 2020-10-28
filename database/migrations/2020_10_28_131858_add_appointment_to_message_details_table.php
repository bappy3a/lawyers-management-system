<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAppointmentToMessageDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('message_details', function (Blueprint $table) {
            $table->integer('appointment')->nullable();
            $table->string('appointment_date')->nullable();
            $table->double('appointment_amount')->default(0,00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('message_details', function (Blueprint $table) {
            //
        });
    }
}
