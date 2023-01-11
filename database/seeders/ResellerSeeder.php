<?php

namespace Database\Seeders;

use App\Models\Reseller;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reseller::create([
            'first_name' => 'پارس',
            'last_name' => 'نویس',
            'nice_name' => '',
            'token' => (string) Str::uuid(),
            'charge' => 10000000,
            'national_id' => '',
            'email' => 'm.shoa@parsnevis.ir',
            'mobile' => '09352829214',
            'phone' => '',
//            'profile_image' => '',
//            'background_image' => '',

//            'default_language' => '',
            'password' => Hash::make('mo75so80'),
//            'last_ip' => '',
//            'last_login_at' => '',
            'activated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
