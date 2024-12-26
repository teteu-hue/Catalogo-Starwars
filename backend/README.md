# Catalogo Starwars

Rodar o projeto
```bash
php -S localhost:8081 -t public
```

## Descricao

Utilizando a api do Star Wars como fonte de informação, construa uma tela web com um catálogo, contendo todos os filmes, ordenados por data de lançamento, exibindo nome e data de lançamento de cada um.

 

Ao clicar em um dos filmes, deverá ser exibido:

                - Nome;

                - Nº episódio;

                - Sinopse;

                - Data de lançamento;

                - Diretor(a);

                - Produtor(es);

                - Nome dos personagens;

                - A idade dos filmes em anos, meses e dias.

 

URLs da api do Star Wars, escolha uma para utilizar no seu projeto:

                https://swapi.dev/

                https://swapi.py4e.com/

                https://www.swapi.tech/

                https://swapi-node.vercel.app/

 

O layout da aplicação pode ser criado por você.

Faça as exibições em telas distintas, deverá ser possível acessar os detalhes e voltar ao catálogo de filmes.

Em seu backend, crie uma api para consumir a api do Star Wars, podendo utilizar a biblioteca cURL, por exemplo.

A idade dos filmes deverá ser calculada no backend.

Seu frontend deve fazer requisições para sua própria api local.

Crie endpoints distintos para cada tipo de requisição.

A cada vez que houver interação com a api do projeto, guarde um log na base de dados com dados como:

                - data/hora

                - solicitação realizada

 

Você poderá utilizar das seguintes linguagens: php, mysql, javascript, html e css.

 

Você poderá:

                - Usar a criatividade e criar mais três features que não estão nesta descrição;

                - Utilizar o banco para guardar mais informações, caso tenha necessidade, como erros de retorno da api, por exemplo;

                - Estruturar o projeto no padrão MVC.

 

 

IMPORTANTE:

                1. Utilizar o PHP 7.4;

                2. Utilizar Programação Orientação a Objeto;

                3. Você não poderá utilizar frameworks no PHP, o código terá de ser 100% seu. No frontend você poderá utilizar JQuery e Bootstrap somente;

                4. Ao concluir o teste, deverá ser encaminhado um arquivo compactado (.zip, .rar, ...) contendo:

                               - Todo o código fonte;

                               - Dump da base de dados;

                               - Criar uma pasta dentro do seu projeto contendo:

                                               - Instruções de instalação detalhadas;

                                               - Documentação de uso da sua api;

                                               - Lista das melhorias aplicadas.
