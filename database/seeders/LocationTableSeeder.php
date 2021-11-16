<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->truncate();

        DB::table('locations')->insert([
            ['name'=>'melbourne', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'sydney', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'perth', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'brisbane', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
        ]);
    }
}
