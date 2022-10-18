<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\TwigMiddleware;
use Slim\Views\Twig;

require __DIR__ . '/../vendor/autoload.php';

$container = require_once __DIR__ . '/../bootstrap.php';

AppFactory::setContainer($container);

$app = AppFactory::create();

$twig = Twig::create('../templates', ['cache' => false]);

$app->add(TwigMiddleware::create($app,$twig));


$app->get('/', function (Request $request, Response $response, $args) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'hello.twig', [
    ]);
});

$app->get('/test/{name}', function (Request $request, Response $response, $args) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'hello.twig', [
        'name' => $args['name']
    ]);
});



$app->get('/users', \App\UserController::class . ':test');

$app->run();
