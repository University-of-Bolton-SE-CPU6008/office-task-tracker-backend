<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at'=>'2020-06-18 19:43:54.000000',
                'state' =>true,
                'user_level_id' => '1',
                'password' => Hash::make('admin'),
                'user_role' => \App\Models\User\UserLevel::where('scope','admin')->first()->id,

            ]

        ]);
    }
}
