<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        input{
            background-color: red;
        }
        </style>
    <title>Restablecimiento de Contraseña</title>
</head>
<body>
    <h2>Restablecimiento de Contraseña</h2>
    <form action="{{ route('password.update') }}" method="POST">
        @csrf 
        @method('POST')
        <input type="hidden" name="token" value="{{ request()->token }}"> 

        <input type="email" name="email" value="{{ request()->email}}">
        
        <label for="password">Nueva Contraseña:</label>
        <input type="password" name="password" placeholder="Nueva contraseña" required>

        <label for="password_confirmation">Confirmar Contraseña:</label>
        <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>

        <input type="submit" value="Restablecer Contraseña">
    </form>
</body>
</html>
