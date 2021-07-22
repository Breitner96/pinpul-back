<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensaje contacto pinpul</title>
</head>
<body>
    <!-- Mensaje que llega al correo de pinpul -->
    <h1>¡Hola {{ $data->nombre }}!</h1>
    <p>Hemos recibido satisfactoriamente tú mensaje, nos pondremos en contácto lo antes posible a tú email <strong>{{ $data->email }}</strong> o número de teléfono <strong>{{ $data->tel }}</strong></p>
</body>
</html>