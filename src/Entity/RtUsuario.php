<?php

namespace App\Entity;

use App\Repository\RtUsuarioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RtUsuarioRepository::class)]
#[ORM\Table(name: "rt_usuario",schema: "public")]
class RtUsuario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: "id_usuario",nullable: false)]
    private ?Usuario $usuario = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: "id_rt",nullable: false)]
    private ?Rt $rt = null;

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

    public function getRt(): ?Rt
    {
        return $this->rt;
    }

    public function setRt(?Rt $rt): static
    {
        $this->rt = $rt;

        return $this;
    }
}
