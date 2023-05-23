# Setup do ambiente de desenvolvimento

São necessárias as seguintes dependências:

* make
* node
* yarn
* docker
* composer

Execute os comandos a seguir para rodar uma instância do MySQL e o Wordpress com o tema já ativado, disponível em http://localhost:8000:

```
$ make build
$ make run
```

Para ativar o recarregamento automático do tema no navegador:

```
make dev
```
