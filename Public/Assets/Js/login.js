async function requestLogin(event) {
    event.preventDefault();

    const email = document.querySelector('input[name="email"]').value;
    const password = document.querySelector('input[name="password"]').value;

    if (!email || !password) {
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/login/request-login', true);
    
    // Definir cabeçalhos, indicando que os dados são JSON
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onload = function() {
        const response = JSON.parse(xhr.responseText);
        console.log(response);

        if (response.message === "Login successful") {
            window.location.href = "/";  // Redireciona para a página inicial
        } else {
            alert(response.message);  // Exibe a mensagem de erro
        }
    };

    // Enviar os dados no corpo da requisição como JSON
    xhr.send(JSON.stringify({ email: email, password: password }));
}
