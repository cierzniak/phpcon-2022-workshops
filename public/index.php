<?php declare(strict_types=1);


use SimpleConverter\Temperature\Controller\TemperatureConverterController;

require_once __DIR__ . '/../vendor/autoload.php';

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->get('/', [TemperatureConverterController::class, 'converterForm']);
    $r->post('/', [TemperatureConverterController::class, 'convert']);
});

$uri = $_SERVER['REQUEST_URI'];
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        die('Not found');
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        die('Method not allowed');
}

print call_user_func($routeInfo[1]);
