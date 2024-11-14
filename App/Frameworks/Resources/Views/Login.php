<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./Assets/Css/login.css">

    <title>Login</title>
</head>
<body>
    <div class="login-container">

        <h1>Tela de Login</h1>
        <form onsubmit="requestLogin(event)">
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="password" placeholder="Senha" required>
            <button type="submit">Entrar</button>
        </form>
    </div>

    <script src="./Assets/Js/login.js"></script>
</body>
</html>
