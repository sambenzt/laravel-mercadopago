<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_save_notification_information()
    {
        $data = [
            'data1' => 'value1',
            'data2' => 'value2'
        ];

        $response = $this->post('/api/notifications?param1=1&param2=2', $data);

        $response->assertStatus(200);

        $this->assertEquals('notification ok', $response->getContent());

        $this->assertDatabaseHas('notifications', [
            'id'   => 1,
            'url'  => env('APP_URL') . '/api/notifications?param1=1&param2=2',
            'json' => json_encode($data),
        ]);
    }
}
