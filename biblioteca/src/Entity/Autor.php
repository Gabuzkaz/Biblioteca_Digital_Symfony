<?php

namespace App\Entity;

use App\Repository\AutorRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Libro;

#[ORM\Entity(repositoryClass: AutorRepository::class)]
#[ORM\Table(name: "autores")]
class Autor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "id_autor")]
    private ?int $id = null;

    #[ORM\Column(name: "nombre", length: 150, nullable: false)]
    #[Assert\NotBlank(message: "El nombre no puede estar vacío.")]
    #[Assert\Length(
        min: 2,
        max: 150,
        minMessage: "El nombre debe tener al menos {{ limit }} caracteres.",
        maxMessage: "El nombre no puede superar los {{ limit }} caracteres."
    )]
    private ?string $nombre = null;

    #[ORM\Column(name: "nacionalidad", length: 150, nullable: false)]
    #[Assert\NotBlank(message: "La nacionalidad es obligatoria.")]
    #[Assert\Length(
        min: 2,
        max: 150,
        minMessage: "La nacionalidad debe tener al menos {{ limit }} caracteres.",
        maxMessage: "La nacionalidad no puede superar los {{ limit }} caracteres."
    )]
    private ?string $nacionalidad = null;

    #[ORM\Column(name: "anio_nacimiento", type: "integer", nullable: true)]
    #[Assert\Type(type: "integer", message: "El año debe ser un número entero válido.")]
    #[Assert\Range(
        min: 1800,
        max: 2025,
        notInRangeMessage: "El año de nacimiento debe estar entre {{ min }} y {{ max }}."
    )]
    private ?int $anio_nacimiento = null;

    // ⭐ RELACIÓN INVERSA: Un autor tiene muchos libros
    #[ORM\OneToMany(mappedBy: "autor", targetEntity: Libro::class)]
    private Collection $libros;

    public function __construct()
    {
        $this->libros = new ArrayCollection();
    }

    // GETTERS / SETTERS

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): static
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getNacionalidad(): ?string
    {
        return $this->nacionalidad;
    }

    public function setNacionalidad(?string $nacionalidad): static
    {
        $this->nacionalidad = $nacionalidad;
        return $this;
    }

    public function getAnioNacimiento(): ?int
    {
        return $this->anio_nacimiento;
    }

    public function setAnioNacimiento(?int $anio_nacimiento): static
    {
        $this->anio_nacimiento = $anio_nacimiento;
        return $this;
    }

    /**
     * @return Collection<int, Libro>
     */
    public function getLibros(): Collection
    {
        return $this->libros;
    }
}
