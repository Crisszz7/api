<!DOCTYPE html>
<html>
<head>
    <title>Restablecimiento de Contraseña</title>
</head>
<body>
    <h2>Hola,</h2>
    <p>Recibimos una solicitud para restablecer tu contraseña. Si no fuiste tú, ignora este mensaje.</p>
    <p>Para cambiar tu contraseña, haz clic en el siguiente botón:</p>
    <a href="{{ $actionUrl }}" 
       style="background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
        Restablecer Contraseña
    </a>
    <p>Si tienes problemas con el botón, copia y pega este enlace en tu navegador:</p>
    <p>{{ $actionUrl }}</p>
    <br>
    <p>Saludos,<br><strong>{{ config('app.name') }}</strong></p>
    <b> {{ $actionUrl}}</b>
</body>
</html>
