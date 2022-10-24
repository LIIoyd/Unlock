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

  public function display(ResponseInterface $response , $val = null , $mes = null , $combineMessage = null){
    $card = $this->cardService->getAllVisibleCard();
    
    return $this->view->render($response, 'app.twig', [
        'tabCard' => $card,
        'value' => $val,
        'message' => $mes,
        'combineMessage'=> $combineMessage ,
      ]);

  }

  public function test(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $this->display($response);
    return $response;
  }

  public function piocher(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $card = null;
    $card = $this->cardService->ModifyCard($_POST["cardId"]);
    $mes = 'Card draw';
    if ($card == null) {
      $mes = 'Card not found';
    }   
    $this->display($response, $card);

    return $response;
  }

   public function discard(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $card = null;
    $mes = 'Card discarded';
    $card = $this->cardService->ModifyCard($_POST["cardIdDiscard"], 0);
    if ($card == null) {
      $mes = 'Card not found';
    }     
    $this->display($response, null , $mes);
    return $response;
  }

public function combine(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $card = null;
    $mes = 'Card combined';
    $card1 = $this->cardService->getCard($_POST["combineFirst"], 0);
    $card2 = $this->cardService->getCard($_POST["combineSecond"], 0);
    if($card1->getSide() == 1 && $card2->getSide() == 1){
      $card = $this->cardService->ModifyCard($_POST["combineFirst"] + $_POST["combineSecond"] , 1);
    }

    if ($card == null) {
      $mes = 'Card not found';
    }else{
      $card1 = $this->cardService->ModifyCard($_POST["combineFirst"], 0);
      $card2 = $this->cardService->ModifyCard($_POST["combineSecond"], 0);
    }
    $this->display($response, null , null , $mes);
    return $response;
  }


}
