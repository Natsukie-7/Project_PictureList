<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="<?php echo $this->requestFile('logoPrinterest.png'); ?>" type="image/png">

    <title>Login</title>
    <link rel="stylesheet" href="<?php $this->cssEnv("style") ?>">
</head>
<body>
    <main class="container">
        <form id="login-form" onsubmit="requestLogin(event)">
            <h1>Login</h1>
            
            <!-- Campo de Email -->
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Digite seu email" required>
            
            <!-- Campo de Senha -->
            <label for="password">Senha</label>
            <input type="password" id="password" name="password" placeholder="Digite sua senha" required>
            
            <!-- Botão de Login -->
            <button type="submit">Entrar</button>
        </form>
        
        <!-- Botão Âncora -->
        <a href="/register" class="register-link">Não tem uma conta? Cadastre-se</a>
    </main>

    <script src="<?php $this->requestJsScript("login"); ?>"></script>
</body>
</html>
