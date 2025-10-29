<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Extension;

class ExtensionSeeder extends Seeder
{
    public function run()
    {
        for ($i = 4000; $i <= 4999; $i++) {
            Extension::firstOrCreate(['numero' => $i]);
        }
    }
}
