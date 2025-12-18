<?php

namespace App\Entity;

use App\Repository\EditorialRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EditorialRepository::class)]
#[ORM\Table(name: "editorial")]
class Editorial
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "id_editorial")]
    private ?int $id = null;

    #[ORM\Column(name: "nombre", length: 150, unique: true)]
    #[Assert\NotBlank(message: "El nombre de la editorial es obligatorio.")]
    #[Assert\Length(
        min: 2,
        max: 150,
        minMessage: "El nombre debe tener al menos {{ limit }} caracteres.",
        maxMessage: "El nombre no puede superar los {{ limit }} caracteres."
    )]
    private ?string $nombre = null;

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

    public function __toString(): string
    {
        return $this->nombre ?? '';
    }
}
