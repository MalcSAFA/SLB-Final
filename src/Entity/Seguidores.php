<?php

namespace App\Entity;

use App\Repository\SeguidoresRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeguidoresRepository::class)]
#[ORM\Table(name: "seguidores",schema: "agitane")]
class Seguidores
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $seguidores = null;

    #[ORM\Column]
    private ?int $seguidos = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: "id_perfil",nullable: false)]
    private ?Perfil $perfil = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeguidores(): ?int
    {
        return $this->seguidores;
    }

    public function setSeguidores(int $seguidores): static
    {
        $this->seguidores = $seguidores;

        return $this;
    }

    public function getSeguidos(): ?int
    {
        return $this->seguidos;
    }

    public function setSeguidos(int $seguidos): static
    {
        $this->seguidos = $seguidos;

        return $this;
    }

    public function getPerfil(): ?Perfil
    {
        return $this->perfil;
    }

    public function setPerfil(?Perfil $perfil): static
    {
        $this->perfil = $perfil;

        return $this;
    }
}
