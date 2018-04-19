<?php

use Illuminate\Database\Seeder;

class DevUserDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Admin account
        ---------------------------------------------------------------------*/

        $userId = DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@progression-dev.com',
            'password' => '$2y$10$d4jDXvvpIgz.PXd28bw8U./hYFuufA26UWRzyhqLKBR7MqR4z9QkG',
            'trial_ends_at' => '2037-04-23 05:16:21',
            'last_read_announcements_at' => '2018-04-13 05:16:21',
            'created_at' => '2018-04-13 05:16:21',
            'updated_at' => '2018-04-13 05:16:21'
        ]);

        DB::table('api_tokens')->insert([
            'id' => 'bb8b705b-20f0-4bd4-a8d0-09619c275adc',
            'user_id' => $userId,
            'name' => 'LOCAL DEV TOKEN',
            'token' => '9sb06v0pHHrrhAfEtt1TJeetBjqyrWdmU99MWwTZh1GUB3J2fJgxcWXAQF90',
            'metadata' => json_encode([]),
            'created_at' => '2018-04-13 05:16:35',
            'updated_at' => '2018-04-13 05:16:35'
        ]);
    }
}
