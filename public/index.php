<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\TwigMiddleware;
use Slim\Views\Twig;

if (!isset($_COOKIE['card'])) {
    $arrCard = [];
    setcookie("card", json_encode($arrCard), time()+60*60*24*100, "/");
}


require __DIR__ . '/../vendor/autoload.php';


$container = require_once __DIR__ . '/../bootstrap.php';

AppFactory::setContainer($container);

$app = AppFactory::create();

$twig = Twig::create('../templates', ['cache' => false]);

$app->add(TwigMiddleware::create($app,$twig));


$app->get('/', function (Request $request, Response $response, $args) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'app.twig', [
    ]);
});

$app->post('/', \App\draw::class . ':piocher');


$app->get('/test/{name}', function (Request $request, Response $response, $args) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'app.twig', [
        'name' => $args['name']
    ]);
});

$app->get('/card', \App\CardController::class . ':test');

$app->get('/users', \App\UserController::class . ':test');

$app->run();
