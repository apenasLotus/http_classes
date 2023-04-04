<?php

declare(strict_types=1);

namespace HttpClasses;

class Request
{
  private static self $instance;

  private static array
    $headers,
    $postVars,
    $queryParams;

  private static string
    $httpMethod,
    $uri;

  private function __construct()
  {
    self::$headers = getallheaders();
    self::$queryParams = $_GET ?? [];
    self::$httpMethod = $_SERVER['REQUEST_METHOD'];
    self::$uri = $_SERVER['PATH_INFO'] ?? '/';

    $this->setPostVars();
  }

  public static function create(): self
  {
    if (empty(self::$instance) || !isset(self::$instance))
      self::$instance = new self;

    return self::$instance;
  }

  public function getHttpMethod(): string
  {
    return self::$httpMethod;
  }

  public function getQueryParams(): array
  {
    return self::$queryParams;
  }
  public function getQueryParam(string|int $field): int|string
  {
    return self::$queryParams[$field] ? self::$queryParams[$field] : null;
  }

  public function getHeaders(): array
  {
    return self::$headers;
  }

  public function getHeader(string|int $field): int|string
  {
    return self::$headers[$field] ? self::$headers[$field] : null;
  }

  public function getPostVars(): array
  {
    return self::$postVars;
  }

  public function getPostVar(string|int $field): int|string
  {
    return self::$postVars[$field] ? self::$postVars[$field] : null;
  }

  public function getUri(): string
  {
    return self::$uri;
  }

  private function setPostVars(): void
  {
    $postVars = $_POST ?? [];
    $inputVars = json_decode(file_get_contents('php://input') ?? [], true);

    self::$postVars = [...$postVars, ...$inputVars];
  }

  private function setQueryParams(string $queryString): void
  {
    $explodeQuery = explode('&', $queryString);
    foreach ($explodeQuery as $_ => $value) {
      $keyAndValue = explode('=', $value);
      $queryParams[$keyAndValue[0]] = $keyAndValue[1];
    }

    self::$queryParams = $queryParams;
  }
}
