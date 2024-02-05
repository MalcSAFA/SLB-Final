<?php

namespace App\Entity;

use App\Repository\PerfilRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PerfilRepository::class)]
#[ORM\Table(name:"perfil", schema: "Agitane")]
class Perfil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $subidas = null;

    #[ORM\Column(length: 255)]
    private ?string $estado = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: "id_usuario",nullable: false)]
    private ?Usuario $usuario = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: "id_tweet", nullable: false)]
    private ?Tweets $tweets = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubidas(): ?int
    {
        return $this->subidas;
    }

    public function setSubidas(int $subidas): static
    {
        $this->subidas = $subidas;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): static
    {
        $this->estado = $estado;

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

    public function getTweets(): ?Tweets
    {
        return $this->tweets;
    }

    public function setTweets(?Tweets $tweets): static
    {
        $this->tweets = $tweets;

        return $this;
    }


}
