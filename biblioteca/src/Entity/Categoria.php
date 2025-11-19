<?php

namespace App\Entity;

use App\Repository\CategoriaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategoriaRepository::class)]
#[ORM\Table(name: "categorias")]
class Categoria
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "id_categoria")]
    private ?int $id = null;

    #[ORM\Column(name: "nombre", length: 150, nullable: false, unique: true)]
    #[Assert\NotBlank(message: "El nombre de la categoría no puede estar vacío.")]
    #[Assert\Length(
        min: 2,
        max: 150,
        minMessage: "El nombre debe tener al menos {{ limit }} caracteres.",
        maxMessage: "El nombre no puede superar los {{ limit }} caracteres."
    )]
    private string $nombre;

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
}
