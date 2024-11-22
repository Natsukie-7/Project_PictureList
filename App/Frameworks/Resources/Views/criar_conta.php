<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta</title>
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

    <main class="container">
        <form action="process_signup.php" method="POST">
            <h1>Criar Conta</h1>
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Digite seu email" required>
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" placeholder="Crie uma senha" required>
            <button type="submit">Criar Conta</button>
        </form>
    </main>
</body>
</html>
