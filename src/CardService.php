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

    public function getCard(int $num)
    {
        $repo = $this->em->getRepository(Card::class);
        $card = $repo->findOneBy(
            array('number'=>$num)
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

}
