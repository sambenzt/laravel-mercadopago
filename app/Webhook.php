<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Webhook extends Model
{
    protected $fillable = ['id_notificacion', 'estados', 'indice_actual', 'json'];
}
