# Setup do ambiente de desenvolvimento

São necessárias as seguintes dependências:

* make
* node
* npm
* docker
* docker-compose
* composer

Execute os comandos a seguir para rodar uma instância do MySQL e o Wordpress com o tema já ativado, disponível em http://localhost:8000:

```
$ make setup
$ make run
```

Para ativar o recarregamento automático do tema no navegador:

```
make dev
```

# Estrutura do projeto

```
docker # imagem docker do wordpress com plugins necessários e ativação do tema local
docker-compose.yml # ambiente de desenvolvimento com banco de dados e WordPress
Makefile # definições de tasks básicas para uso com o Make
theme # 
|- assets # arquivos de media para placeholder
|- dist # arquivos javascript and css gerados (build do npm)
|- node_modules # dependências do npm
|- src # código-fonte do tema
|- vendor # dependências do composer
|- composer.json # definição do projeto do composer (dependências)
|- composer.lock # lock de dependências do composer
|- functions.php # definições extras do tema para o WordPress
|- index.php # entrada principal do site
|- package.json # definição do projeto do npm (dependências)
|- package-lock.json # lock de dependências do npm
|- style.css # definição de tema do WordPress
```
