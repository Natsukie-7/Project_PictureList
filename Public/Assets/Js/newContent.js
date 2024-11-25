async function upload(event) {
    event.preventDefault();  // Impede o envio tradicional do formulário

    // Seleciona os elementos do formulário
    const fileInput = document.getElementById('imageFile');
    const titleInput = document.getElementById('imageTitle');
    const responseMessage = document.getElementById('response-message') || document.createElement('div');

    // Valida se a imagem e o título estão preenchidos
    if (!fileInput.files.length || !titleInput.value) {
        responseMessage.textContent = "Por favor, preencha todos os campos.";
        responseMessage.style.color = "red";
        document.body.appendChild(responseMessage);
        return;
    }

    const file = fileInput.files[0];
    const title = titleInput.value;

    // Cria um FileReader para ler a imagem e convertê-la para base64
    const reader = new FileReader();
    reader.onloadend = function () {
        const base64Image = reader.result.split(',')[1]; // Remove o prefixo "data:image/jpeg;base64,"

        // Cria um XMLHttpRequest
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '/upload-file', true);

        // Define o cabeçalho da requisição
        xhr.setRequestHeader('Content-Type', 'application/json');

        // Define o que fazer quando a requisição terminar
        xhr.onload = function () {
            const data = JSON.parse(xhr.responseText);

            if (xhr.status === 200) {
                window.location.href = `/file?${data.fileId}`
            }
        };

        // Envia os dados para o servidor
        xhr.send(JSON.stringify({
            imageData: base64Image,
            imageTitle: title
        }));
    };

    // Lê a imagem como base64
    reader.readAsDataURL(file);
}
