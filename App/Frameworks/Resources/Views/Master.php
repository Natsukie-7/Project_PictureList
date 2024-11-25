<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="<?php $this->cssEnv("style") ?>">
    <link rel="stylesheet" href="<?php $this->cssEnv("Global") ?>">
    <link rel="stylesheet" href="<?php $this->cssEnv("Master") ?>">

    <link rel="icon" href="<?php echo $this->requestFile('logoPrinterest.png'); ?>" type="image/png">

    <?php require "MasterComponents/MasterCss.php" ?>

    <title><?php echo $title ?></title>
</head>
<body>
    <!-- Menu Superior -->
    <?php require "MasterComponents/Header.php" ?>

    <main>
        <?php echo $this->load(); ?>
    </main>

    
    <?php if ($this->isArtist("get")): ?>
        <button id="new-picture-button" title="Adicionar novo conteúdo" onclick="window.location.href='/new-content';">+</button>
    <?php endif; ?>


    <?php require "MasterComponents/MasterJs.php" ?>
</body>
</html>