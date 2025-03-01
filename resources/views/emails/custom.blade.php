<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: auto; background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .button { display: inline-block; padding: 10px 20px; background: #3490dc; color: #fff; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hola, {{ $user->name }}</h2>
        <p>Hemos recibido una solicitud para restablecer tu contraseña.</p>
        <p>
            <a href="{{  }}" class="button">Restablecer Contraseña</a>
        </p>
        <p>Si no realizaste esta solicitud, ignora este mensaje.</p>
    </div>
</body>
</html>
