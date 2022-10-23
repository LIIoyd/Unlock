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

    public function getCard(int $num)
    {
        $repo = $this->em->getRepository(Card::class);
        $card = $repo->findOneBy(
            array('number'=>$num)
        );
        $this->logger->info(json_encode($card));

        return $card;
    }
}
