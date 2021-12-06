<?php

namespace App\Http\Controllers;

use App\Webhook;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function create(Request $request) {

        $request->validate([
            'id_notificacion' => 'required', 
            'estados' => 'required', 
        ]);

        $webhook = Webhook::where(['id_notificacion' => $request->id_notificacion])->first();

        if(!$webhook) {
            $webhook = Webhook::create([
                'id_notificacion' => $request->id_notificacion,
                'estados' => json_encode($request->estados),
                'json' => json_encode($request->post())
            ]);
        }

        $statuses = json_decode($webhook->estados);

        $index = intval( $webhook->indice_actual ); 

        $status = $statuses[ $index ];

        if($index < count($statuses) - 1) {
            $webhook->indice_actual = $index + 1;
        }

        $webhook->ultimo_estado = $status;
        $webhook->save();
        return response()->json(['message' => 'status ' . $status ], $status);

    }   

    public function logs() {

        $webhooks = Webhook::orderBy('created_at', 'DESC')->get();

        return view('webhook', compact('webhooks'));
    }

    public function delete($id) {

        if($id == 'all') {
            Webhook::query()->delete();
        }
        else {
            $webhook = Webhook::findOrFail($id);
            $webhook->delete();
        }

        return redirect()->back();
    }
}
