
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Recuperacion de contraseña </title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif" >
    <div style="max-width: 80vw; max-height:auto; padding:10px 12px; color:black; dispaly:flex; flex-direction:column; justify-content:space-around;"  >
        <h1 style="color: rgb(74, 187, 53)" style="font-family: monospace"> Hola, somos el equipo de EMSAT </h1>
        <p>Recibimos una solicitud para restablecer tu contraseña. Si no fuiste tú, ignora este mensaje.</p>
        <p>Para cambiar tu contraseña, haz clic en el siguiente botón:</p>
         <a href="{{ $actionUrl }}" 
           style="background-color: #249942; color: white; text-decoration: none; padding:5px 10px; border-radius: 5px; margin:5px 5px;">
            Restablecer Contraseña
        </a>
        <br>
        <p>Si tienes problemas con el botón, copia y pega este enlace en tu navegador:</p>
        <p>{{ $actionUrl }}</p>
        <br>
        <p>Saludos,<br><strong>{{ config('app.name') }}</strong></p>
    </div>
</body>
</html>
