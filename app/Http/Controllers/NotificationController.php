<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class NotificationController extends Controller
{
    public function index(Request $request) {

        Notification::create([
            'url' =>   $_SERVER['REMOTE_ADDR'] . ' - ' .  $request->getQueryString(),
            'json' => json_encode($request->post())
        ]);

        return 'notification ok';

    }

    public function logs() {

        $notifications = Notification::orderBy('created_at', 'DESC')->get();

        return view('logs', compact('notifications'));
    }

    public function runMigrations() {
        Artisan::call("migrate");
        return 'migrations ok';
    }
}
