<?php
namespace App\Domain;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table(name: 'party')]
final class Party{

    #[Id, Column(type: 'integer'), GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[Column(type: 'integer', unique: true, nullable: false)]
    private int $idUser;

    #[Column(type: 'integer', unique: true, nullable: false)]
    private string $idDeck;

    public function __construct($titre,$difficul)
    {
        $this->titre = $titre;
        $this->difficul = $difficul; 
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getIdUser(): string
    {
        return $this->idUser;
    }

    public function getIdDeck(): int
    {
        return $this->idDeck;
    }
}