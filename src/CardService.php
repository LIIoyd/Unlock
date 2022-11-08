<?php

namespace App;

use Doctrine\ORM\EntityManager;
use App\Domain\Card;
use Psr\Log\LoggerInterface;

final class CardService
{
    private EntityManager $em;

    public function __construct(EntityManager $em, LoggerInterface $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
    }

    public function ModifyCard($num,$s = 1){
        $card = $this->getCard($num);
        $this->logger->info("Modification de la carte, avant modification :". $card->getNumber() . ' ' . $card->getSide());
        if(! $card == null){    
            $card->setSide($s);
            $this->em->persist($card);
            $this->em->flush();
        }
        $this->logger->info("Modification de la carte, après modification :". $card->getNumber()  . ' ' . $card->getSide());
        return $card;

    }

    public function getCard(string $num)
    {
        $repo = $this->em->getRepository(Card::class);
        $card = $repo->findOneBy(
            array('card_number'=>$num)
        );
        if($card !== null){
            $this->logger->info("carte renvoyé par getCard() :".$card->getNumber());
        }else{
            $this->logger->info("carte non trouvée");
        }
        return $card;
    }

    public function getAllVisibleCard(){
        $repo = $this->em->getRepository(Card::class);
        $card = $repo->findBy(
            array('side' => 1)
        );
        $log = "tab [";
        foreach ($card as $c){
            $log .= ','. $c->getNumber();
        }
        $this->logger->info("tableau de carte visible :". $log . ']');
        return $card;
    
    }

    public function resetGame(){
        $repo = $this->em->getRepository(Card::class);
        $tab = $repo->findAll();
        foreach($tab as $card){
            if($card->getNumber() == "63" || $card->getNumber() == "15" || $card->getNumber() == "32" || $card->getNumber() == "21" || $card->getNumber() == "80"){
                $card->setSide(1);
                $this->logger->info("carte visible : ".$card->getNumber());
                $this->em->persist($card);
                $this->em->flush();
            }else{
                $card->setSide(0);
                $this->logger->info("carte caché : ".$card->getNumber());
                $this->em->persist($card);
                $this->em->flush();
            }
        }
    }

}
