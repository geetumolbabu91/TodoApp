<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class TodoListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('todo')->insert([
            'name' => 'Example Todo',
            'description' => 'This is an example todo',
            'due_date' => '2022-04-04',
            'is_complete' => true
        ]);
    }
}
