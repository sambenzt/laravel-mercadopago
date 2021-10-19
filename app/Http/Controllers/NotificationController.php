<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request) {

        Notification::create([
            'url' => $request->fullUrl(),
            'json' => json_encode($request->post())
        ]);

        return 'notification ok';

    }
}
