<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class NotificationController extends Controller
{
    public function index(Request $request) {

        Notification::create([
            'url' => $request->fullUrl(),
            'json' => json_encode($request->post())
        ]);

        return 'notification ok';

    }

    public function logs() {

        $notifications = Notification::all();

        return view('logs', compact('notifications'));
    }

    public function runMigrations() {
        Artisan::call("migrate");
        return 'migrations ok';
    }
}
