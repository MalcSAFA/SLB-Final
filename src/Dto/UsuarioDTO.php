<?php

namespace App\Dto;

class UsuarioDTO
{
    private ?int $id = null;
    private ?string $nombre = null;
    private ?string $apellido = null;
    private ?Integer $nick = null;
    private ?Integer $contrasenya = null;
    private ?Integer $correo = null;
    private ?Integer $foto = null;
    private ?\DateTimeInterface $fecha_nacimiento = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): void
    {
        $this->nombre = $nombre;
    }



    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(?string $apellido): void
    {
        $this->apellido = $this->apellido;
    }

    public function getNick(): ?string
    {
        return $this->nick;
    }

    public function setNick(?string $nick): void
    {
        $this->nick = $this->nick;
    }

    public function getContrasenya(): ?string
    {
        return $this->contrasenya;
    }

    public function setContrasenya(?string $contrasenya): void
    {
        $this->contrasenya = $this->contrasenya;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(?string $foto): void
    {
        $this->foto = $this->foto;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(?string $correo): void
    {
        $this->correo = $this->correo;
    }

    public function getFecha_nacimiento(): ?\DateTimeInterface
    {
        return $this->fecha_nacimiento;
    }

    public function setFecha_nacimiento(?\DateTimeInterface $fecha_nacimiento): void
    {
        $this->fecha_nacimiento = $this->fecha_nacimiento;
    }



}