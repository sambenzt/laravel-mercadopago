<?php

use App\Notification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 10; $i++) {

            Notification::create([
                'url'  => env('APP_URL') . "/param{$i}=value{$i}",
                'json' => '{
                    "elements": null,
                    "next_offset": 0,
                    "total": '. $i .'
                }'
            ]);

        }
    }
}
