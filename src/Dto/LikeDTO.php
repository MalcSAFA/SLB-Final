<?php

namespace App\Dto;

class LikeDTO
{
    private ?int $id = null;
    private ?string $seguidor = null;
    private ?string $seguido = null;
    private ?Integer $id_perfil = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getSeguidor(): ?string
    {
        return $this->seguidor;
    }

    public function setSeguidor(?string $seguidor): void
    {
        $this->seguidor = $seguidor;
    }



    public function getseguido(): ?string
    {
        return $this->seguido;
    }

    public function setseguido(?string $seguido): void
    {
        $this->seguido = $this->seguido;
    }

    public function getId_perfil(): ?int
    {
        return $this->id_perfil;
    }

    public function setId_perfil(?int $id_perfil): void
    {
        $this->id_perfil = $this->id_perfil;
    }



}