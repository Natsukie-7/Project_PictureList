// Função para carregar todas as imagens do banco de dados
async function loadAllFiles() {
    try {
        // Requisição para buscar as imagens via API
        const response = await fetch('/get-all-files');
        const data = await response.json();

        // Verifica se há imagens
        if (data.files && data.files.length > 0) {
            const imageGallery = document.getElementById('imageGallery');
            imageGallery.innerHTML = '';  // Limpa a galeria antes de adicionar as imagens

            // Adiciona as imagens à galeria
            data.files.forEach(file => {
                const imgElement = document.createElement('img');
                imgElement.src = 'data:image/jpeg;base64,' + file.link;  // Exibe a imagem usando base64
                imgElement.alt = file.title;

                // Cria o contêiner para a imagem
                const div = document.createElement('div');
                div.classList.add('image-item');
                div.appendChild(imgElement);

                // Adiciona a descrição da imagem
                const p = document.createElement('p');
                p.textContent = file.title;
                div.appendChild(p);

                const link = document.createElement('a');
                link.href = `/file?${file.id}`;  // A URL para a página do arquivo usando o ID
                link.title = file.title; 

                link.appendChild(div);

                // Adiciona o item na galeria
                imageGallery.appendChild(link);
            });
        } else {
            console.log("Nenhuma imagem encontrada.");
        }
    } catch (error) {
        console.error("Erro ao carregar as imagens:", error);
    }
}

// Chama a função assim que a página for carregada
window.onload = loadAllFiles;
