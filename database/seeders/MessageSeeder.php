<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('messages')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@example.com',
            'message' => Str::random(150),
            'user_id' => rand(1, 13),
        ]);
    }
}
