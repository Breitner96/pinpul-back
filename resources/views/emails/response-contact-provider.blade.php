<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensaje recibo</title>
</head>
<body>
    <!-- Mensaje del proveedor al usuario, que confirma que su correo fue recibo -->
    <h1>¡Hola {{ $data->full_name }}!</h1>
    <small>Empresa: {{ $data->company }}</small>
    <p>Hemos recibido satisfactoriamente tú mensaje, nos pondremos en contácto lo antes posible a tú email <strong>{{ $data->email }}</strong> o número de teléfono <strong>{{ $data->phone }}</strong></p>
</body>
</html>