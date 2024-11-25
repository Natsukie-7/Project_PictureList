<?php 
    $this->extends(
        "Master", 
        [
            "title" => $title,
            "childCss" => [
                "Assets/Css/Content.css"
            ],
            "childScripts" => [
                "Assets/Js/content.js"
            ]
        ]
    )
?>

<div class="file-container">
    <h1><?php echo htmlspecialchars($file['title']); ?></h1>
    <div class="file-content">
        <?php if (!empty($file['link'])): ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($file['link']); ?>" alt="<?php echo htmlspecialchars($file['title']); ?>">
        <?php else: ?>
            <p>Arquivo não disponível.</p>
        <?php endif; ?>
    </div>
</div>

<h2>Arquivos Recomendados</h2>
<div class="recommended-files">
    <?php foreach ($recommended as $recommendedFile): ?>
        <div class="recommended-item">
            <!-- Link para redirecionar para a página do arquivo -->
            <a href="/file?<?php echo $recommendedFile['id']; ?>">
                <div class="file-item">
                    <!-- Verifica se o arquivo tem link e exibe a imagem -->
                    <?php if (!empty($recommendedFile['link'])): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($recommendedFile['link']); ?>" alt="<?php echo htmlspecialchars($recommendedFile['title']); ?>">
                    <?php else: ?>
                        <p>Arquivo não disponível.</p>
                    <?php endif; ?>
                    <p><?php echo htmlspecialchars($recommendedFile['title']); ?></p>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>
