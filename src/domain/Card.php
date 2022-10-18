<?php
namespace App\Domain;

use Doctrine\DBAL\Types\BooleanType;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity, Table(name: 'card')]
final class Card{

    #[Id, Column(type: 'integer'), GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[Column(type: 'integer', unique: true, nullable: false)]
    private int $number;

    #[Column(type: 'string', unique: true, nullable: false)]
    private string $type;

    #[Column(type: 'boolean', unique: true, nullable: false)]
    private BooleanType $retrun;

    #[Column(type: 'string', unique: true, nullable: false)]
    private string $img;

    public function __construct($num,$type,$img)
    {
        $this->number = $num;
        $this->type = $type;
        $this->retrun = false;
        $this->img = $img; 
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

    public function getRetrun(): BooleanType
    {
        return $this->retrun;
    }

    public function getImg(): string
    {
        return $this->img;
    }
}