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

  public function game(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $this->display($response);
    return $response;
  }

  public function piocher(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $card = $this->cardService->getCard($_POST["cardId"]);
    if ($card == null) {
      $mes = 'Card not found';
    }else{
      $card = $this->cardService->ModifyCard($_POST["cardId"]);
      $mes = 'Card draw';
    }
    $this->display($response, $mes);

    return $response;
  }

   public function discard(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $card = $this->cardService->getCard($_POST["cardIdDiscard"]);
    if ($card == null) {
      $mes = 'Card not found';
    }else{
      $mes = 'Card discarded';
      $card = $this->cardService->ModifyCard($_POST["cardIdDiscard"], 0);
    }
    $this->display($response, null , $mes);
    return $response;
  }

public function combine(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $mes = "";
    if(!is_string($_POST["combineFirst"]) || !is_string($_POST["combineSecond"])){
      $card = $this->cardService->getCard($_POST["combineFirst"] + $_POST["combineSecond"]);
      $mes = 'Card combined';
      if ($card == null) {
        $mes = 'Card not found';
      }else{
        $card = $this->cardService->ModifyCard($_POST["combineFirst"] + $_POST["combineSecond"],1);
        $card1 = $this->cardService->getCard($_POST["combineFirst"]);
        $card2 = $this->cardService->getCard($_POST["combineSecond"]);
        if($card1 !== null){
          $card1 = $this->cardService->ModifyCard($_POST["combineFirst"], 0);
        }
        if($card2 !== null){
          $card2 = $this->cardService->ModifyCard($_POST["combineSecond"], 0);
        }
      }  
    }
    $this->display($response, null , null , $mes);
      return $response;
  }

  public function reset(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $game = $this->cardService->resetGame();
    $this->display($response, null , null , null);
    return $response;
  }

}
