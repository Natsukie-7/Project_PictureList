<?php $this->extends("Master", ["title" => $title, "childCss" => ["Assets/Css/NewContent.css"], "childScripts" => ["Assets/Js/newContent.js"]]) ?>

<div class="container">
    <h1>Adicionar Nova Imagem</h1>
    <form id="content-form" onsubmit="upload(event)">
        <div class="form-group">
            <label for="imageFile">Selecione a Imagem:</label>
            <input type="file" id="imageFile" name="imageFile" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="imageTitle">Título da Imagem:</label>
            <input type="text" id="imageTitle" name="imageTitle" required>
        </div>
        <button type="submit" class="submit-button">Enviar</button>
    </form>
</div>