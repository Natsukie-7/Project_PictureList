<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="<?php echo $this->requestFile('logoPrinterest.png'); ?>" type="image/png">

    <title>Criar Conta</title>
    <link rel="stylesheet" href="<?php $this->cssEnv("style") ?>">
</head>
<body>
    <main class="container">
        <form id="register-form" onsubmit="requestRegister(event)">
        <h1>Criar Conta</h1>
            
            <!-- Nome -->
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>
            
            <!-- Email -->
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Digite seu email" required>
            
            <!-- Senha -->
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" placeholder="Crie uma senha" required>
            
            <!-- Pergunta: Você é artista? -->
            <label for="artista">Você é artista?</label>
            <select id="artista" name="artista" required>
                <option value="" disabled selected>Selecione uma opção</option>
                <option value="sim">Sim</option>
                <option value="nao">Não</option>
            </select>
            
            <!-- Botão de criar conta -->
            <button type="submit">Criar Conta</button>
        </form>

        <p class="login-link">
            Já tem uma conta? <a href="/login">Faça login</a>.
        </p>
    </main>

    <script src="<?php $this->requestJsScript("register"); ?>"></script>
</body>
</html>
