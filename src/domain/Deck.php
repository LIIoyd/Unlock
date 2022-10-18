<?php
namespace App\Domain;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table(name: 'deck')]
final class Deck{

    #[Id, Column(type: 'integer'), GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[Column(type: 'string', unique: true, nullable: false)]
    private int $titre;

    #[Column(type: 'integer', unique: true, nullable: false)]
    private string $difficulty;

    public function __construct($titre,$difficul)
    {
        $this->titre = $titre;
        $this->difficul = $difficul; 
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function getDifficulty(): int
    {
        return $this->difficulty;
    }
}