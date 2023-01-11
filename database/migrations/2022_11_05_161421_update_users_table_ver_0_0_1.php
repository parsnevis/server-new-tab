<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTableVer001 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');


            $table->string('first_name');
            $table->string('last_name');
            $table->string('nice_name')->nullable();

            $table->foreignId('reseller_id')->constrained('resellers');
            $table->string('national_id', 10)->unique()->nullable();
            $table->string('mobile', 32)->unique()->nullable();
            $table->string('phone', 32)->nullable();
            $table->string('profile_image')->default('assets/images/avatar/avatar-1.png');
            $table->string('background_image')->default('assets/images/background/background.png');

            $table->string('last_ip', 40)->nullable();
            $table->timestamp('last_login_at')->nullable();

            $table->timestamp('mobile_verified_at')->nullable();
            $table->timestamp('activated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
