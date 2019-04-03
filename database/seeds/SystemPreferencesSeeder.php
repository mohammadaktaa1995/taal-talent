<?php

use App\SystemPreferences;
use Illuminate\Database\Seeder;

class SystemPreferencesSeeder extends Seeder
{

    public function run()
    {
        SystemPreferences::insert([
            ['key_name' => 'contact_phone', 'key_value' => ''],
            ['key_name' => 'contact_email', 'key_value' => ''],
        ]);
    }

}
