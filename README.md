# PictureList

## Pré-requisitos

Antes de começar, verifique se você tem o Composer instalado em sua máquina. Caso não tenha, você pode baixá-lo em [getcomposer.org](https://getcomposer.org).

## Iniciando o Projeto

Siga os passos abaixo para configurar e iniciar o projeto:

1. **Clone o repositório:**

   Abra o terminal e execute os seguintes comandos:

   ```bash
   git clone https://github.com/Natsukie-7/Project_PictureList.git
   cd Project_PictureList
   ```

2. **Instale as dependências:**

   Para instalar as dependências do projeto, execute o comando:

   ```bash
   composer install
   ```

3. **Instancie as dependências:**

   Após a instalação, instancie as dependências com o seguinte comando:

   ```bash
   composer du
   ```

4. **Inicialize o servidor:**

   Finalmente, inicie o servidor com o comando:

   ```bash
   composer run
   ```

Configuração do banco de dados:

Renomeie o arquivo .env.example para .env.
Preencha as credenciais do banco de dados no arquivo .env.

No MySQL, execute o seguinte comando para garantir que o tamanho máximo de pacote seja suficiente para o projeto:
SET GLOBAL max_allowed_packet=67108864;
