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

  public function display(ResponseInterface $response , $v = null){
    $card = $this->cardService->getAllVisibleCard();
    
    return $this->view->render($response, 'app.twig', [
        'tabCard' => $card,
        'value' => $v,
      ]);

  }

  public function test(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $this->display($response);
    return $response;
  }

  public function piocher(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {

    $card = $this->cardService->ModifyCard($_POST["cardId"]);
    $this->display($response, $card);

    return $response;
}

}
