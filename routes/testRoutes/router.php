<?php

use HttpClasses\Router;

Router::get('/teste', [
  // Router::MIDDLEWARES => [
  // ],
  function () {
    echo '<pre>';
    print_r('opa');
    echo '</pre>';
    exit;
  }
]);
