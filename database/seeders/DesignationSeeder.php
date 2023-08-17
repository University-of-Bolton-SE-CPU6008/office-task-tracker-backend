<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('designations')->insert([
            ['designation_name' => 'QA'],
            ['designation_name' => 'Developer'],
            ['designation_name' => 'BA']

        ]);
    }
}
