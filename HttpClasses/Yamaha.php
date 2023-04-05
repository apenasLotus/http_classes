<?php

namespace HttpClasses;

use HttpClasses\AbstractMiddleware;
use HttpClasses\Request;

class Yamaha
{
  public function handle(Request $request, \Closure $next)
  {
    return 'opa';
  }
}
