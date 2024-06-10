<?php

namespace App\Entity;

use App\Repository\SeguidoresRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeguidoresRepository::class)]
#[ORM\Table(name: "seguidores", schema: "public")]
class Seguidores
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: "id_usuario_seguidor", type: 'integer')]
    private ?int $idUsuarioSeguidor = null;

    #[ORM\Column(name: "id_usuario_seguido", type: 'integer')]
    private ?int $idUsuarioSeguido = null;

    #[ORM\Column(name: "fecha_seguimiento", type: 'datetime')]
    private ?\DateTimeInterface $fechaSeguimiento;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUsuarioSeguidor(): ?int
    {
        return $this->idUsuarioSeguidor;
    }

    public function setIdUsuarioSeguidor(int $idUsuarioSeguidor): static
    {
        $this->idUsuarioSeguidor = $idUsuarioSeguidor;

        return $this;
    }

    public function getIdUsuarioSeguido(): ?int
    {
        return $this->idUsuarioSeguido;
    }

    public function setIdUsuarioSeguido(int $idUsuarioSeguido): static
    {
        $this->idUsuarioSeguido = $idUsuarioSeguido;

        return $this;
    }

    public function getFechaSeguimiento(): ?\DateTimeInterface
    {
        return $this->fechaSeguimiento;
    }

    public function setFechaSeguimiento(\DateTimeInterface $fechaSeguimiento): static
    {
        $this->fechaSeguimiento = $fechaSeguimiento;

        return $this;
    }
}
