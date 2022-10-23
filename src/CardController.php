<?php
namespace App;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class CardController
{
  private $view;

  public function __construct(Twig $view, CardService $cardService)
  {
    $this->view = $view;
    $this->cardService = $cardService;
  }

  public function test(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $card = $this->cardService->getCard(34);
    $tabCard = [$card];
    return $this->view->render($response, 'app.twig', [
      'tabCard' => $tabCard,
    ]);
    return $response;
  }
}
