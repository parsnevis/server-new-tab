<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            
            $table->string('first_name');
            $table->string('last_name');
            $table->string('nice_name')->nullable();
            
            // $table->string('national_id', 10)->unique()->nullable();
            $table->foreignId('region_id')->nullable()->constrained('regions');
            $table->string('email')->unique();
            $table->string('mobile', 32)->unique()->nullable();
            $table->string('phone', 32)->nullable();
            $table->string('local_phone', 32)->nullable();
            $table->string('position')->nullable();
            $table->string('profile_image')->default('assets/images/avatar/avatar-1.png');
            $table->string('background_image')->default('assets/images/background/background.png');
            
            $table->timestamp('activated_at')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
