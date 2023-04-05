<?php

namespace HttpClasses\Middlewares;

use HttpClasses\Request;

abstract class AbstractMiddlewares
{
  final public function __invoke(Request $request, \Closure $controller)
  {
    return $this->handle($request, $controller);
  }

  abstract public function handle(Request $request, \Closure $controller);
}
