# tech-challenge-fiap-fase-01
Sistema de Gerenciamento de Pedidos - Lanchonete

### Instalação
AJUSTAr!!!!!!!! (remover .env, vendor e criar instalador)
1. Clonar o Projeto
2. Esse projeto possui Makefile, para subir o container basta executar `make up`
3. Existe um arquivo `index.php` na pasta `public`, nele é possível simular a aplicação
4. Para velo rodando localmente, basta acessar o endereço [localhost](http://localhost:8089/), rodando na porta `:8089`

### Acessar o Container

1. Executar o comando `make bash` para testes de Unidade

### Testes

1. Executar o comando `make test` para testes de Unidade
1. Executar o comando `make test-coverage` para testes de Unidade com geração de HTML coma cobertura dos testes [`challenge-fiap-fase-01/coverage/index.html`]
1. Executar o comando `make infection` para testes de Mutação via infection
1. Executar testes dentro do container `./vendor/bin/phpunit --coverage-html coverage`
