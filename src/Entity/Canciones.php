<?php

namespace App\Entity;

use App\Repository\CancionesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CancionesRepository::class)]
class Canciones
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "El nombre es obligatorio")]
    private ?string $nombre = null;

    #[ORM\Column(length: 4)]
    #[Assert\NotBlank(message: "El año de publicación es obligatorio")]
    private ?string $publicacion = null;

    #[ORM\ManyToOne(inversedBy: 'canciones')]
    #[Assert\NotBlank(message: "El artista es obligatorio")]
    private ?Artista $artista = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getPublicacion(): ?string
    {
        return $this->publicacion;
    }

    public function setPublicacion(string $publicacion): self
    {
        $this->publicacion = $publicacion;

        return $this;
    }

    public function getArtista(): ?Artista
    {
        return $this->artista;
    }

    public function setArtista(?Artista $artista): self
    {
        $this->artista = $artista;

        return $this;
    }
}
