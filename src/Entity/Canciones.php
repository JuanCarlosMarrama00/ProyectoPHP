<?php

namespace App\Entity;

use App\Repository\CancionesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CancionesRepository::class)]
class Canciones
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $artista = null;

    #[ORM\Column(length: 4)]
    private ?string $publicacion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getArtista(): ?string
    {
        return $this->artista;
    }

    public function setArtista(string $artista): static
    {
        $this->artista = $artista;

        return $this;
    }

    public function getPublicacion(): ?string
    {
        return $this->publicacion;
    }

    public function setPublicacion(string $publicacion): static
    {
        $this->publicacion = $publicacion;

        return $this;
    }
}