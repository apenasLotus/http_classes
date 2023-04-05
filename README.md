# HTTP_CLASSES

Projeto que visa facilitar a criação de rotas em projetos php para uso pessoal. Contudo, a implementação do mesmo está abaixo. _'Bosorte'_ !

## Rotas

A criação de rotas segue uma árvore contendo duas 'camadas' de pastas até chegar nos arquivos de rotas em si.

- Arquivo raiz
  - Pasta da rota
  - Arquivo de Rota em si

> TODO - Tenho de mudar isso, mas por enquanto vou usando assim.

## Inciando o Router

O objeto de roteamento é iniciado de forma estática e retorna um objeto do mesmo.
```php
// No index do projeto

$routesHttpClass = Router::init(__DIR__.'caminho/das/rotas');
$routerHttpClass->run()
  ->sendResponse();
```
> O método `run()` executa a rota e retorna uma instancia de response, onde é passado um `sendResponse()` para enviar a resposta, cabeçalhos e afins.

## Criação das Rotas

As rotas são criadas de forma estática, recebendo como parâmetros, a rota sendo acessada e um array, onde dentro o mesmo deve conter uma Closure/função que será usada como controlador, tal como opcionalmente,  middlewares e regras passados é claro, em arrays separados.

> Exemplo de uso:

```php
use HttpClasses\Router;

// Lembre-se de passar um 'use' no middleware que for usar, caso contrário o mesmo vai ser passado como uma string
use HttpClasses\ExampleMiddleware;

// Obs: os parâmetros da rota devem ser declarados entre chaves '{}', e passados nos parâmetros da função
Router::post('/example/route', [
  Router::MIDDLEWARES => [
    ExampleMiddleware::class
  ],
  function () {
    return (new ExampleController)->exampleMethod();
  }
]);
```

## Response

Todas as respostas atualmente são transformadas em `json` e retornadas.

> TODO - Explicar melhor como funcionam as classes mais afundo. 
