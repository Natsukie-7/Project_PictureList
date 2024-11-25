async function requestRegister(event) {
    event.preventDefault();

    // Obtém os valores dos campos do formulário
    const nome = document.querySelector('input[name="nome"]').value;
    const email = document.querySelector('input[name="email"]').value;
    const senha = document.querySelector('input[name="senha"]').value;
    const artista = document.querySelector('select[name="artista"]').value;

    // Validação simples
    if (!nome || !email || !senha || !artista) {
        alert("Por favor, preencha todos os campos.");
        return;
    }

    // Configura a requisição
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/register/request-register', true);

    // Define os cabeçalhos indicando JSON
    xhr.setRequestHeader('Content-Type', 'application/json');

    // Callback para lidar com a resposta
    xhr.onload = function () {
        const response = JSON.parse(xhr.responseText);

        if (xhr.status === 200) {
            window.location.href = "/";
        } 
    };

    // Envia os dados no formato JSON
    xhr.send(JSON.stringify({
        nome: nome,
        email: email,
        senha: senha,
        artista: artista
    }));
}
