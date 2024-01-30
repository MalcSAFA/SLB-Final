<?php

namespace App\Entity;

use App\Repository\LikeUsuarioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LikeUsuarioRepository::class)]
#[ORM\Table(name:"likes_usuario", schema: "Agitane")]
class LikeUsuario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: "id_usuario",nullable: false)]
    private ?Usuario $usuario = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: "id_likes",nullable: false)]
    private ?Likes $likes = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLikes(): ?Likes
    {
        return $this->likes;
    }

    public function setLikes(?Likes $likes): static
    {
        $this->likes = $likes;

        return $this;
    }
}
