<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Logs Mercado Pago</title>
</head>
<body>
    <div class="container-fluid p-5">

        <div class="row">
            <div class="col-12">
                <h1>Logs Mercado Pago</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>URL</th>
                            <th>Created</th>
                            <th>JSON Data</th>
                            <th>
                                <a href="{{ url('/logs/delete/all') }}" onClick="confirm('eliminar?')" class="btn btn-danger ml-2">Eliminar todo</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notifications as $i => $notification)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $notification->url }}</td>
                                <td>{{ $notification->created_at }}</td>
                                <td>{{ $notification->json }}</td>
                                <td>
                                    <a href="{{ url('/logs/delete/' . $notification->id) }}" onClick="confirm('eliminar?')" class="btn btn-danger">Eliminar</a>
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