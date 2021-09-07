<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('assets/css/login.css')}} ">
        <title>Login</title>
    </head>
    <body>
        <div class="login-container">
            <div class="item-container">
                <div class="img">
                    <img src="{{asset('assets/img/icon-title.png')}}" alt="Logo"/>
                </div>
                <form action="/" method="post">
                    @csrf
                    <p>Faça seu login</p>
                    <input name='email' type='email' placeholder="Digite seu E-mail" required />
                    <input name='password' type='password' placeholder="Digite sua senha" required />
                    <button>Entrar</button>
                </form>
            </div>
        </div>
    </body>
</html>