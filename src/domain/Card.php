<?php
namespace App\Domain;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table(name: 'card')]
final class Card{

    #[Id, Column(type: 'integer'), GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[Column(type: 'string', nullable: false)]
    private int $number;

    #[Column(type: 'string', nullable: false)]
    private string $type;

    #[Column(type: 'integer', nullable: false)]
    private int $side;

    #[Column(type: 'string', nullable: false)]
    private string $img;

    #[Column(type: 'string', nullable: false)]
    private string $imgDos;

    public function __construct($num,$type,$img,$imgDos)
    {
        $this->number = $num;
        $this->type = $type;
        $this->side = 0;
        $this->img = $img;
        $this->imgDos = $imgDos;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getSide(): int
    {
        return $this->side;
    }

    public function getImg(): string
    {
        return $this->img;
    }

    public function getImgDos(): string
    {
        return $this->imgDos;
    }

    public function setSide($s){
        $this->side = $s;
    }

    public function __toString()
    {
        return $this->id . ' '. $this->number.' '. $this->type;
    }
}