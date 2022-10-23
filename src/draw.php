<?php
namespace App;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class draw
{
  private $view;

  public function __construct(Twig $view)
  {
    $this->view = $view;
  }

  public function piocher(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $data = json_decode($_COOKIE['card'],true);
    array_push($data,$_POST["cardId"]);
    setcookie('card',json_encode($data) , time()+3600, '/');
    return $this->view->render($response, 'app.twig', [
        'value' => $_POST["cardId"],
        'tabCard' => $data,
    ]);
    return $response;
  }
}
