<?php 

// Autoload files using the Composer autoloader.
require_once __DIR__ . '/../vendor/autoload.php';

//use Application\GetRequest;
use Application\Services\GetRequestService;
use Dotenv\Dotenv;

$dotenv = Dotenv::createUnsafeImmutable(__DIR__.'/../');
$dotenv->load();

//$request = GetRequest::request();
$request = GetRequestService::getRequest();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'Application\Form/renderForm');
    $r->addRoute('GET', '/counties', 'Application\RouteEndpoints\GetAllCounties/response');
    $r->addRoute('POST', '/citiesbycounty', 'Application\RouteEndpoints\GetAllCitiesByCounty/response');
    //$r->addRoute('POST', '/addcounty', 'Application\County/addCounty');
    $r->addRoute('POST', '/addcitybycountyid', 'Application\RouteEndpoints\AddCityToCounty/response');
    $r->addRoute('POST', '/deletecitybyid', 'Application\RouteEndpoints\DeleteCityById/response');
    $r->addRoute('POST', '/updatecitynamebyid', 'Application\RouteEndpoints\UpdateCityNameById/response');
    $r->addRoute('POST', '/gettranslation', 'Application\RouteEndpoints\GetTranslation/response');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        // ... call $handler with $vars
        list($class, $method) = explode("/", $handler, 2);

        $reflectionClass = new ReflectionClass($class);
        $reflectionMethod = $reflectionClass->getMethod($method);

        $instanceFromReflection = $reflectionClass->newInstanceArgs(array($request));

        echo $reflectionMethod->invoke($instanceFromReflection);
        break;
}