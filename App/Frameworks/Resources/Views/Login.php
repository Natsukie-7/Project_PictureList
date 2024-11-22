<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Menu Superior -->
    <header>
        <nav>
            <a href="index.php" class="logo-container">
                <img src="logoPrinterest.png" alt="Logo do Pinterest" class="logo">
                <span class="logo-text">Pinterest</span>
            </a>
            <div class="menu-buttons">
                <a href="login.php" class="button red">Entrar</a>
                <a href="criar_conta.php" class="button gray">Criar Conta</a>
            </div>
        </nav>
    </header>

    <!-- Conteúdo Principal -->
    <main class="container">
        <form action="process_login.php" method="POST">
            <h1>Login</h1>
            
            <!-- Campo de Email -->
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Digite seu email" required>
            
            <!-- Campo de Senha -->
            <label for="password">Senha</label>
            <input type="password" id="password" name="password" placeholder="Digite sua senha" required>
            
            <!-- Botão de Login -->
            <button type="submit">Entrar</button>
            
            <!-- Mensagem de Erro -->
            <?php if (isset($_GET['error'])) : ?>
                <p style="color: red;">Email ou senha inválidos.</p>
            <?php endif; ?>
        </form>
    </main>
</body>
</html>
