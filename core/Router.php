<?php
class Router
{
  static  $routes = [];

  static function get(string $path, callable $handler): void
  {
    $path = $path;
    static::$routes['GET'][$path] = $handler;
  }

  static function post(string $path, callable $handler)
  {
    static::$routes['POST'][$path] = $handler;
  }

  static function redirect(string $route, int $code): void
  {
    http_response_code($code);
    header("location: " . $route);
  }

  public function matcher(string $path, string $route): array
  {
    $pattern = preg_replace("#\{\w+\}#", "([^\/]+)", $route);

    if (preg_match("#^$pattern$#", $path, $matches)) {
      return $matches;
    } else return [];
  }

  static function getDispatcher(string $path): void
  {
    foreach (static::$routes["GET"] as $route => $handler) {

      if (!empty(static::matcher($path, $route))) {
        $matches =  static::matcher($path, $route);
        array_shift($matches);
        // echo json_encode($matches);

        call_user_func($handler, $matches[0] ?? "");
        break;
      }
    }
  }

  static function postDispatcher(string $path): void
  {
    foreach (static::$routes["POST"] as $route => $handler) {
      if (!empty(static::matcher($path, $route))) {
        $matches = static::matcher($path, $route);
        array_shift($matches);
        call_user_func($handler, $matches[0] ?? "");
        break;
      }
    }
  }

  static function dispatch(string $path): void
  {
    if (isset($_SERVER['REQUEST_METHOD'])) {
      switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
          static::getDispatcher($path);
          break;
        case 'POST':
          static::postDispatcher($path);
          break;
        default:
          echo '<h1 style="text-align:center;">404 Page not found </h1>';
          break;
      }
    } else return;



    // foreach (static::$routes as $route => $handler) {

    //   $pattern = preg_replace("#\{\w+\}#", "([^\/]+)", $route);
    //   echo $route . "<br>";
    //   echo $pattern . "<br>", PHP_EOL;
    //   echo $path . "<br>", PHP_EOL;

    //   if (preg_match("#^$pattern$#", $path, $matches)) {
    //     echo 'matched';
    //   } else {
    //     echo "404 page not found";
    //   }
    // }
    // echo json_encode($matches), PHP_EOL;
  }
}
