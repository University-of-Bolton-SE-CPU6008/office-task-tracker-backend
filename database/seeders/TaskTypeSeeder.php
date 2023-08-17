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
            [ 'type_name' => 'Bug Fixing', 'type_color' => '#FF0000' ],
            [ 'type_name' => 'Developments', 'type_color' => '#00FFFF' ],
            [ 'type_name' => 'Support', 'type_color' => '#0000FF' ],
            [ 'type_name' => 'Learning', 'type_color' => '#FFC0CB' ],
            [ 'type_name' => 'Knowledge Sharing', 'type_color' => '#00008B' ],
            [ 'type_name' => 'Documentation', 'type_color' => '#ADD8E6' ],
            [ 'type_name' => 'Client Meeting', 'type_color' => '#800080' ],
            [ 'type_name' => 'Project Meeting', 'type_color' => '#FFFF00' ],
            [ 'type_name' => 'UI / UX', 'type_color' => '#00FF00' ],
            [ 'type_name' => 'Designing', 'type_color' => '#FF00FF' ],
            [ 'type_name' => 'Research', 'type_color' => '#808080' ]
        ]);
    }
}
