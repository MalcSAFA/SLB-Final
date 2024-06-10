<?php

namespace App\Entity;

use App\Repository\UsuarioListaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsuarioListaRepository::class)]
#[ORM\Table(name: "usuario_lista", schema: "public")]
class UsuarioLista
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Usuario::class)]
    #[ORM\JoinColumn(name: "id_usuario", referencedColumnName: "id", nullable: false, onDelete: "CASCADE")]
    private ?Usuario $usuario;

    #[ORM\ManyToOne(targetEntity: Lista::class)]
    #[ORM\JoinColumn(name: "id_lista", referencedColumnName: "id", nullable: false, onDelete: "CASCADE")]
    private ?Lista $lista;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getLista(): ?Lista
    {
        return $this->lista;
    }

    public function setLista(?Lista $lista): self
    {
        $this->lista = $lista;

        return $this;
    }
}
