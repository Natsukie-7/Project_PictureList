<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Imagens</title>
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
                <a href="logout.php" class="button gray">Sair</a>
            </div>
        </nav>
    </header>

    <!-- Conteúdo Principal -->
    <main class="container">
        <h1>Bem-vindo, <?= htmlspecialchars($_SESSION['user_name']) ?></h1>

        <!-- Formulário de Upload -->
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <label for="image">Escolha uma imagem para enviar:</label>
            <input type="file" id="image" name="image" required>
            <button type="submit">Enviar Imagem</button>
        </form>

        <!-- Mensagens de Sucesso/Erro -->
        <?php if ($success) : ?>
            <p style="color: green;"><?= $success ?></p>
        <?php endif; ?>
        <?php if ($error) : ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>

        <!-- Lista de Imagens Enviadas -->
        <h2>Imagens Enviadas</h2>
        <div class="image-gallery">
            <?php foreach ($uploadedImages as $image) : ?>
                <div class="image-item">
                    <img src="<?= $uploadDir . $image ?>" alt="Imagem">
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>
