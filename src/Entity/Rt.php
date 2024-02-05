<?php

namespace App\Entity;

use App\Repository\RtRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RtRepository::class)]
#[ORM\Table(name:"rt", schema: "Agitane")]
class Rt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $recuento = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: "id_usuario", nullable: false)]
    private ?Usuario $usuario = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: "id_tweet", nullable: false)]
    private ?Tweets $tweet = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecuento(): ?int
    {
        return $this->recuento;
    }

    public function setRecuento(int $recuento): static
    {
        $this->recuento = $recuento;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getTweet(): ?Tweets
    {
        return $this->tweet;
    }

    public function setTweet(?Tweets $tweet): static
    {
        $this->tweet = $tweet;

        return $this;
    }
}
