<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Logs Webhooks</title>
</head>
<body>
    <div class="container-fluid p-5">

        <div class="row">
            <div class="col-12">
                <h1>Logs Webhooks</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID NOTIFICACION</th>
                            <th>TOKEN</th>
                            <th>ESTADOS</th>
                            <th>ULTIMO ESTADO ENVIADO</th>
                            <th>CREADO</th>
                            <th>ACTUALIZADO</th>
                            <th>
                                <a href="{{ url('/logs/webhook/all') }}" onClick="confirm('eliminar?')" class="btn btn-danger ml-2">Eliminar todo</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($webhooks as $webhook)
                            <tr>
                                <td>{{ $webhook->id_notificacion }}</td>
                                <td>{{ $webhook->token }}</td>
                                <td>{{ $webhook->estados }}</td>
                                <td>{{ $webhook->ultimo_estado }}</td>
                                <td>{{ $webhook->created_at }}</td>
                                <td>{{ $webhook->updated_at }}</td>
                                <td>
                                    <a href="{{ url('/logs/webhook/' . $webhook->id) }}" onClick="return confirm('eliminar?')" class="btn btn-danger">Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html>