<?php

require_once(__DIR__.'/../vendor/autoload.php');

use Psr\Http\Server\RequestHandlerInterface;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Project\System\Infrastructure\Environment;
use Psr\Container\ContainerInterface;

$path = ($_SERVER['PATH_INFO']) ?? null;
$routes = require(__DIR__."/../config/routes.php");

if(!array_key_exists($path, $routes) || is_null($path)){
    http_response_code(404);
    exit();
}

session_start();
Environment::load(__DIR__.'/../config/');

$noAuthorization = require(__DIR__."/../config/noAuthorization.php");

if(!isset($_SESSION['logged_user']) && !in_array($path, $noAuthorization)){
    header('Location: /login');
    exit();
}

$psr17Factory = new Psr17Factory();

$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

$request = $creator->fromGlobals();

$classController = $routes[$path];
/** @var ContainerInterface $container */
$container = require(__DIR__."/../config/dependencies.php");

/** @var RequestHandlerInterface $controller */
$controller = $container->get($classController);
$response = $controller->handle($request);

foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();
