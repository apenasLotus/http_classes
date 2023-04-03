<?php

namespace HttpClasses;

use Closure;

class Router
{
  const MIDDLEWARES = true;

  private static self $instance;

  // Array que armazena todas a rotas do projeto.
  private static array $routes;

  private function __construct()
  {
  }

  public static function init(string $pathRoutes): self
  {
    if (isset(self::$instance))
      return self::$instance;

    if (!file_exists($pathRoutes))
      throw new \Exception("Raiz do arquivo das rotas não encontrado", 500);

    self::includeRoutesArchives($pathRoutes);
    return (self::$instance = new self);
  }

  private static function includeRoutesArchives(string $pathRoutes)
  {
    $archives = glob($pathRoutes . '/*/*.php');
    if (empty($archives) || !isset($archives))
      throw new \Exception("Verifique a arvore de arquivo das rotas", 500);

    foreach ($archives as $route) {
      include_once $route;
    }
  }

  public static function get(string $route, array $params): void
  {
    self::addRoute('GET', $route, $params);
  }

  public static function post(string $route, array $params): void
  {
    self::addRoute('POST', $route, $params);
  }

  public static function put(string $route, array $params): void
  {
    self::addRoute('PUT', $route, $params);
  }

  public static function path(string $route, array $params): void
  {
    self::addRoute('PATH', $route, $params);
  }

  public static function delete(string $route, array $params)
  {
    self::addRoute('DELETE', $route, $params);
  }

  private static function addRoute(string $method, string $route, array $params)
  {
    foreach ($params as $key => $param) {
      if ($param instanceof Closure) {
        $params['controller'] = $param;
        unset($params[$key]);
      }
    }

    $route = '^/' . str_replace('/', '\/', $route) . '$/';
    self::$routes[$route] = [$method => $params];
  }

  /**
   * Executa a rota acessada.
   */
  public function run()
  {
    
  }
}
