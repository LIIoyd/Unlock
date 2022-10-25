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

        if(! $card == null){    
            $card->setSide($s);
            $this->em->persist($card);
            $this->em->flush();
        }

        return $card;

    }

    public function getCard(string $num)
    {
        $repo = $this->em->getRepository(Card::class);
        $card = $repo->findOneBy(
            array('card_number'=>$num)
        );
        $this->logger->info(json_encode($card));

        return $card;
    }

    public function getAllVisibleCard(){
        $repo = $this->em->getRepository(Card::class);
        $card = $repo->findBy(
            array('side' => 1)
        );
        return $card;
    
    }

    public function resetGame(){
        $repo = $this->em->getRepository(Card::class);
        $tab = $repo->findAll();
        foreach($tab as $card){
            if($card->getNumber() == "63" || $card->getNumber() == "15" || $card->getNumber() == "32" || $card->getNumber() == "21" || $card->getNumber() == "80"){
                $card->setSide(1);
                $this->em->persist($card);
                $this->em->flush();
            }else{
                $card->setSide(0);
                $this->em->persist($card);
                $this->em->flush();
            }
        }
    }

}
