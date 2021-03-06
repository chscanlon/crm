<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStagedCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staged_customers', function (Blueprint $table) {
            $table->string('Textbox5');
            $table->string('CustomerId');
            $table->string('DateAdded');
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('CompanyName');
            $table->string('Email');
            $table->string('Telephone');
            $table->string('SmsNumber');
            $table->string('PhysicalAddress1');
            $table->string('PhysicalAddress2');
            $table->string('PhysicalSuburb');
            $table->string('PhysicalCity');
            $table->string('PhysicalState');
            $table->string('PhysicalPostCode');
            $table->string('DateOfBirth');
            $table->string('IsVip');
            $table->string('BookingCount');
            $table->string('LastBookingDate');
            $table->string('Gender');
            $table->string('Occupation');
            $table->string('ReferredBy');
            $table->string('TotalCustomers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staged_customers');
    }
}
