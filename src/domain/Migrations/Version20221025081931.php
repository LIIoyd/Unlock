<?php

declare(strict_types=1);

namespace App\domain\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221025081931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE card (
            id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            card_number varchar(255),
            card_type varchar(255),
            img varchar(255),
            side int(11),
            imgDos varchar(255))');

        $cards = [
            ['card_number' => '4','card_type' => 'bleu','img' => 'deck_cartes_unlock/4/4.png','side' => 0,'imgDos' => 'deck_cartes_unlock/4/4dos.png'],
            ['card_number' => '15','card_type' => 'gris','img' => 'deck_cartes_unlock/15/15.png','side' => 1,'imgDos' => 'deck_cartes_unlock/15/15dos.png'],
            ['card_number' => '21','card_type' => 'jaune','img' => 'deck_cartes_unlock/21/21.png','side' => 1,'imgDos' => 'deck_cartes_unlock/21/21dos.png'],
            ['card_number' => '22','card_type' => 'bleu','img' => 'deck_cartes_unlock/22/22.png','side' => 0,'imgDos' => 'deck_cartes_unlock/22/22dos.png'],
            ['card_number' => '32','card_type' => 'rouge','img' => 'deck_cartes_unlock/32/32.png','side' => 1,'imgDos' => 'deck_cartes_unlock/32/32dos.png'],
            ['card_number' => '35','card_type' => 'bleu','img' => 'deck_cartes_unlock/35/35.png','side' => 0,'imgDos' => 'deck_cartes_unlock/35/35dos.png'],
            ['card_number' => '42','card_type' => 'bleu','img' => 'deck_cartes_unlock/42/42.png','side' => 0,'imgDos' => 'deck_cartes_unlock/42/42dos.png'],
            ['card_number' => '47','card_type' => 'gris','img' => 'deck_cartes_unlock/47/47.png','side' => 0,'imgDos' => 'deck_cartes_unlock/47/47dos.png'],
            ['card_number' => '50','card_type' => 'bleu','img' => 'deck_cartes_unlock/50/50.png','side' => 0,'imgDos' => 'deck_cartes_unlock/50/50dos.png'],
            ['card_number' => '60','card_type' => 'jaune','img' => 'deck_cartes_unlock/60/60.png','side' => 0,'imgDos' => 'deck_cartes_unlock/60/60dos.png'],
            ['card_number' => '63','card_type' => 'rouge','img' => 'deck_cartes_unlock/63/63.png','side' => 1,'imgDos' => 'deck_cartes_unlock/63/63dos.png'],
            ['card_number' => '67','card_type' => 'gris','img' => 'deck_cartes_unlock/67/67.png','side' => 0,'imgDos' => 'deck_cartes_unlock/67/67dos.png'],
            ['card_number' => '73','card_type' => 'jaune','img' => 'deck_cartes_unlock/73/73.png','side' => 0,'imgDos' => 'deck_cartes_unlock/73/73dos.png'],
            ['card_number' => '79','card_type' => 'gris','img' => 'deck_cartes_unlock/79/79.png','side' => 0,'imgDos' => 'deck_cartes_unlock/79/79dos.png'],
            ['card_number' => '80','card_type' => 'bleu','img' => 'deck_cartes_unlock/80/80.png','side' => 1,'imgDos' => 'deck_cartes_unlock/80/80dos.png'],
            ['card_number' => '85','card_type' => 'vert','img' => 'deck_cartes_unlock/85/85.png','side' => 0,'imgDos' => 'deck_cartes_unlock/85/85dos.png'],
            ['card_number' => 'C','card_type' => 'gris','img' => 'deck_cartes_unlock/C/C.png','side' => 0,'imgDos' => 'deck_cartes_unlock/C/Cdos.png'],
            ['card_number' => 'K','card_type' => 'gris','img' => 'deck_cartes_unlock/K/K.png','side' => 0,'imgDos' => 'deck_cartes_unlock/K/Kdos.png'],
            ['card_number' => 'M','card_type' => 'gris','img' => 'deck_cartes_unlock/M/M.png','side' => 0,'imgDos' => 'deck_cartes_unlock/M/Mdos.png'],
            ['card_number' => 'chambre','card_type' => 'gris','img' => 'deck_cartes_unlock/chambre_hotel.png','side' => 1,'imgDos' => 'deck_cartes_unlock/chambre_hotel.png'],
            ['card_number' => 'elite','card_type' => 'gris','img' => 'deck_cartes_unlock/l_elite.png','side' => 1,'imgDos' => 'deck_cartes_unlock/l_elite.png']
        ];

        foreach($cards as $card){
            $this->addSql('INSERT INTO Unlock.card (card_number,card_type,img,side,imgDos) VALUES (:card_number,:card_type,:img,:side,:imgDos)', $card);
        }

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE Card');
    }
}
