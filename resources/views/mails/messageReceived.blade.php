<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        *{
            padding: 0px;
            margin: 0px auto;
            box-sizing: border-box;
        }

        body{
            background-color: rgb(239, 239, 239);
        }

        h2{
            background-color: rgba(188, 255, 179, 0.508);
            padding: 10px 3px;
            border-radius: 5px;
            margin: 5px 5px;
            color:rgb(36, 98, 36);
        }

        .box-container{
            background-color: rgba(255, 255, 255, 0.248);
            width: 40rem;
            height: 30rem;
            margin: auto;
            position: absolute;
            top: 0px;
            bottom: 0px;
            right: 0px;
            left: 0px;
            padding: 10px 12px;
            border-radius: 10px;
            box-shadow: 0px 2px 5px 0px rgb(183, 183, 183);
            font-family: Arial, Helvetica, sans-serif;
            background-color: white;
        }

        form{
            width:100%;
            min-height: 80%;
            background-color: white;
        }

        input{
            min-width: 90%;
            min-height: 3rem;
            border-radius: 10px;
            outline: none;
            border: 0px;
            background-color: rgba(202, 209, 209, 0.508);
            margin: 10px 10px;
            font-size: 20px;
            padding: 10px;
        }

        input[type='submit']{
            background-color: green;
            color: white;
            font-weight: 600;
            font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            width: 100px;
            transition: .3s;
        }

        input[type='submit']:hover{
            background-color: white;
            color: green;
            font-weight: 600;
            font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            width: 100px;
            border: 1px solid green;
        }
    </style>
    <title>Restablecimiento de Contraseña</title>
</head>
<body>
    <div class="box-container">
        <h2>Restablecimiento de Contraseña</h2>
        <form action="{{ route('password.update') }}" method="POST">
            @csrf 
            @method('POST')
            <input type="hidden" name="token" value="{{ request()->token }}" > 
            <b>
            <p> Correo enlazado 
            <input type="email" name="email" value="{{ request()->email}}" style="color:gray; background-color:transparent;">
            </p>
            </b>
            <br>
            <label for="password">Nueva Contraseña:</label>
            <input type="password" name="password" placeholder="Nueva contraseña" required>
            <br>
            <label for="password_confirmation">Confirmar Contraseña:</label>
            <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>
            <input type="submit" value="Restablecer Contraseña">
        </form>
    </div>
</body>
</html>
