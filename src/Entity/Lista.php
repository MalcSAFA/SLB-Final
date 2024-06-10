<?php

namespace App\Entity;

use App\Repository\ListaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListaRepository::class)]
#[ORM\Table(name: "lista", schema: "public")]
class Lista
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre_lista = null;

    #[ORM\ManyToOne(targetEntity: Usuario::class)]
    #[ORM\JoinColumn(name: "id_usuario", referencedColumnName: "id", nullable: false, onDelete: "CASCADE")]
    private ?Usuario $usuario;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreLista(): ?string
    {
        return $this->nombre_lista;
    }

    public function setNombreLista(string $nombre_lista): self
    {
        $this->nombre_lista = $nombre_lista;

        return $this;
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
}
