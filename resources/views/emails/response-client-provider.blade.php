<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensaje recibo</title>
</head>
<body>
    <!-- Mensaje del cliente que llega al correo del proveedor -->
    <h1>El cliente: {{ $data->name }}</h1>
    <small>Empresa: {{ $data->company }}</small>
    <p>Se quiere poner en contacto contigo, estos son sus datos: <br>
    <strong>{{ $data->email }}</strong> o número de teléfono <strong>{{ $data->phone }}</strong></p>
</body>
</html>