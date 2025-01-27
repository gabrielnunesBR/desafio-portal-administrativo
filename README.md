# Desafio Portal Administrativo

Este repositório contém a aplicação de um portal administrativo desenvolvido para fins de desafio.

## Instalação

### 1. Clone o repositório:

```bash
git clone https://github.com/gabrielnunesBR/desafio-portal-administrativo.git
cd desafio-portal-administrativo/
```

### 2. Configure o arquivo .env:

#### Crie o arquivo .env a partir do exemplo fornecido:

```bash
cp .env.example .env
```

#### Preencha os campos do arquivo .env conforme as instruções abaixo:

#### Exemplo de configuração do banco de dados (container):

```bash
MYSQL_DATABASE=desafio_kabum_db
MYSQL_ROOT_PASSWORD=root
```

#### Exemplo de conexão com o banco de dados:

```bash
DB_DRIVER=mysql
DB_HOST=db
DB_PORT=3306
DB_NAME=desafio_kabum_db
DB_USER=root
DB_PASSWORD=root
```

#### Exemplo de credenciais para o primeiro administrador:

```bash
DEFAULT_ADMIN_NAME=Admin1
DEFAULT_ADMIN_EMAIL=admin@example.com
DEFAULT_ADMIN_PASSWORD=secure_password123
```

#### Configurações do JWT:

```bash
JWT_SECRET_KEY=c1ac209b-7817-4369-b4bf-6c15aa8e8b5a
JWT_EXPIRATION=3600
```

### 3. Inicialize os containers:

#### Execute o comando abaixo para iniciar os containers:

```bash
docker-compose up --build
```

#### Como o projeto utiliza o dockerize, você pode observar mensagens como:

```bash
php_app | 2025/01/27 11:03:32 Problem with dial: dial tcp 172.22.0.2:3306: connect: connection refused. Sleeping 1s
```

#### Isso indica que o container está aguardando a inicialização do banco de dados.

#### Quando você visualizar uma mensagem semelhante a esta abaixo, isso indica que o banco de dados foi totalmente inicializado e está pronto para se comunicar com a aplicação.

```bash
php_app | 2025/01/27 11:04:14 Connected to tcp://db:3306
```

### 4. Acesse a aplicação:

#### Abra o navegador e acesse a URL:

```bash
http://localhost:8080/
```

#### Efetue login utilizando as credenciais configuradas no arquivo .env para o administrador padrão:

```bash
DEFAULT_ADMIN_EMAIL=admin@example.com
DEFAULT_ADMIN_PASSWORD=secure_password123
```

#### Agora você pode explorar e utilizar o portal administrativo!
