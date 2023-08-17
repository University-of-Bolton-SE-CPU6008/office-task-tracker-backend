<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('task_types')->insert([
            [ 'type_name' => 'Meeting', 'type_color' => '#000000' ],
            [ 'type_name' => 'Development', 'type_color' => '#FFFF00' ]
        ]);
    }
}
