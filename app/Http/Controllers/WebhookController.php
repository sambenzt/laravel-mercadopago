<?php

namespace App\Http\Controllers;

use App\Webhook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class WebhookController extends Controller
{
    public function create(Request $request) {


        $validator = Validator::make($request->all(), [
            'data.id_notificacion' => 'required', 
            'data.estados' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'status 200' ], 200);
        }
       
        $webhook = Webhook::where(['id_notificacion' => $request->data['id_notificacion']])->first();

        if(!$webhook) {

            $webhook = Webhook::create([
                'id_notificacion' => $request->data['id_notificacion'],
                'estados' => json_encode($request->data['estados']),
                'json' => json_encode($request->post()),
                'token' => $request->headers->has('subscription_key') ? $request->header('subscription_key') : ''
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
