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


$app->get('/game', \App\CardController::class . ':game');

$app->get('/', function ($request, $response, $args) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'homepage.twig', [
    ]);
});


$app->post('/draw', \App\CardController::class . ':piocher');

$app->post('/discard', \App\CardController::class . ':discard');

$app->post('/combine', \App\CardController::class . ':combine');

$app->post('/newgame', \App\CardController::class . ':reset');


$app->run();
