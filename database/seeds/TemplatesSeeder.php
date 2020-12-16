<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('templates')->insert([
            [
                'id' => 1,
                'name' => 'Template 1',
            ],
            [
                'id' => 2,
                'name' => 'Template 2',
            ],
            [
                'id' => 3,
                'name' => 'Template 3',
            ],
        ]);
    }
}
