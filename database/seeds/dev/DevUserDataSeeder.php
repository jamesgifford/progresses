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
            'email' => decrypt('eyJpdiI6ImxcL01sdHkzZXpDYm9Lc3NGM2grUW9BPT0iLCJ2YWx1ZSI6IkVMa2RcLzNsNVYrUElkdjJSRGJYVnlCNkVvSlIwb2NrZWRTb0dRalMwQzFNV2JNVTZRZENCSHJndzRyUTI2eUx3IiwibWFjIjoiODUxOWI5Mzk1MGNkZWRmYWNjZDE1YWI3NTYwNDU3NGVjYTczNDYzYjVkZjgyMGQyY2Q1MDQ2MDllMzA5YmY5NCJ9'),
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
            'token' => decrypt('eyJpdiI6IkVtR2RQaVR2M25KbWpWM0dzQlVybFE9PSIsInZhbHVlIjoiWmNhUTJ5Q1hsT0x4aEFPcjJCWk16TUlTSlVLVllIanVMbjVoV2JMUmFxYmdROEtLOFlFNkNLc2NndUxwcXFyOEt3dnV3ckx5aUErXC9sd2UwUFlPaCtZMjkzVk8xeHFmRHAyczlpRmJxNFlrPSIsIm1hYyI6Ijk4MGQwMjIwZTg5YzhkZjlkMDg3NjA4ZTFkZWZiMWRmMTFkZWYyOGY0MzVjOWIxNThlODAwNTA5NjExZDI4YzMifQ=='),
            'metadata' => json_encode([]),
            'created_at' => '2018-04-13 05:16:35',
            'updated_at' => '2018-04-13 05:16:35'
        ]);
    }
}
