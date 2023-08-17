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
            ['designation_name' => 'Mobile Developer'],
            ['designation_name' => 'QA Engineer'],
            ['designation_name' => 'Project Manager'],
            ['designation_name' => 'Business Analyst'],
            ['designation_name' => 'UI / UX Engineer'],
            ['designation_name' => 'Frontend Web Developer'],
            ['designation_name' => 'Backend Developer'],
            ['designation_name' => 'Supervisor'],
            ['designation_name' => 'Full Stack Developer'],
            ['designation_name' => 'Project Manager'],
            ['designation_name' => 'Sales Manager']

        ]);
    }
}
