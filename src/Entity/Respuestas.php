<?php

namespace App\Entity;

use App\Repository\RespuestasRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RespuestasRepository::class)]
#[ORM\Table(name:"respuestas", schema: "public")]
class Respuestas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $texto = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: "id_tweet", nullable: false)]
    private ?Tweets $tweet = null;

    #[ORM\ManyToOne( targetEntity: Usuario::class)]
    #[ORM\JoinColumn(name: "id_usuario", nullable: false)]
    private Usuario $usuario;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTexto(): ?string
    {
        return $this->texto;
    }

    public function setTexto(string $texto): static
    {
        $this->texto = $texto;

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

    public function getUsuario(): Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(Usuario $usuario): void
    {
        $this->usuario = $usuario;
    }
}
