<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resellers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('company_name');
            $table->string('nice_name')->nullable();
            $table->uuid('token')->unique();
            $table->integer('charge')->default(0);

            $table->string('national_id', 10)->unique()->nullable();
            $table->string('email')->unique();
            $table->string('mobile', 32)->unique()->nullable();
            $table->string('phone', 32)->nullable();

            $table->string('profile_image')->default('assets/images/avatar/avatar-1.png');
            $table->string('background_image')->default('assets/images/background/background.png');
            $table->enum('default_language', array('fa', 'en', 'ar', 'tr'))->default('fa');
            $table->string('password');

            $table->string('last_ip', 40)->nullable();
            $table->timestamp('last_login_at')->nullable();

            $table->timestamp('activated_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resellers');
    }
}
