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
            $table->uuid('uuid');
            $table->foreignId('reseller_id')->constrained('resellers');
            $table->foreignId('package_id')->constrained('packages');
            $table->unsignedInteger('price');
            $table->unsignedInteger('discount');
            $table->unsignedInteger('total_price');
            $table->string('payment_id')->nullable();
            $table->timestamp('payed_at')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
