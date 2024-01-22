<?php

namespace App\Entity;

use App\Repository\NotificacionesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NotificacionesRepository::class)]
#[ORM\Table(name:"notificaciones", schema: "agitane")]
class Notificaciones
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $tipo_notificacion = null;

    #[ORM\Column]
    private ?bool $visto = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: "id_usuarioEm", nullable: false)]
    private ?Usuario $usuario_emisor = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name:"id_usuarioRe", nullable: false)]
    private ?Usuario $usuario_receptor = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipoNotificacion(): ?string
    {
        return $this->tipo_notificacion;
    }

    public function setTipoNotificacion(string $tipo_notificacion): static
    {
        $this->tipo_notificacion = $tipo_notificacion;

        return $this;
    }

    public function isVisto(): ?bool
    {
        return $this->visto;
    }

    public function setVisto(bool $visto): static
    {
        $this->visto = $visto;

        return $this;
    }

    public function getUsuarioEmisor(): ?Usuario
    {
        return $this->usuario_emisor;
    }

    public function setUsuarioEmisor(?Usuario $usuario_emisor): static
    {
        $this->usuario_emisor = $usuario_emisor;

        return $this;
    }

    public function getUsuarioReceptor(): ?Usuario
    {
        return $this->usuario_receptor;
    }

    public function setUsuarioReceptor(?Usuario $usuario_receptor): static
    {
        $this->usuario_receptor = $usuario_receptor;

        return $this;
    }
}
