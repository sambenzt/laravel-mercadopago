<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class NotificationController extends Controller
{
    public function index(Request $request) {

        $HTTP_X_FORWARDED_FOR = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : 'NO';

        $HTTP_CLIENT_IP = !empty($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : 'NO';

        Notification::create([
            'url' => 'REMOTE_ADDR: ' . $_SERVER['REMOTE_ADDR']. ' - HTTP_CLIENT_IP: ' . $HTTP_CLIENT_IP . ' - HTTP_X_FORWARDED_FOR: ' . $HTTP_X_FORWARDED_FOR . ' - query string: ' .  $request->getQueryString(),
            'json' => json_encode($request->post())
        ]);

        return 'notification ok';

    }

    public function logs() {

        $notifications = Notification::orderBy('created_at', 'DESC')->get();

        return view('logs', compact('notifications'));
    }

    public function runMigrations() {
        Artisan::call("migrate:fresh");
        return 'migrations ok';
    }

    public function webhook(Request $request) {

        $arr = [false, true, false, false, true];

        $arr = [false, false, false];

        $value = $arr[ rand(0, count($arr) - 1) ];

        $status = $value ? 200 : 403;

        Notification::create([
            'url' => 'status ' . $status . ' - query string: ' .  $request->getQueryString() ,
            'json' => json_encode($request->post())
        ]);

        return response('notification', $status);

    }

    public function delete($id) {

        if($id == 'all') {
            Notification::query()->delete();
        }
        else {
            $notification = Notification::findOrFail($id);
            $notification->delete();
        }

        return redirect()->back();
    }

}
