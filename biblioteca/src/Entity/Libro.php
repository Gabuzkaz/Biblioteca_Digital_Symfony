<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\LibroRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Autor;
use App\Entity\Categoria;
use App\Entity\Editorial;

#[ORM\Entity(repositoryClass: LibroRepository::class)]
#[ORM\Table(name: "libros")]
class Libro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "id_libro")]
    private ?int $id = null;

    // TÍTULO
    #[Assert\NotBlank(message: "El título no puede estar vacío.")]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: "El título debe tener al menos {{ limit }} caracteres.",
        maxMessage: "El título no puede superar los {{ limit }} caracteres."
    )]
    #[ORM\Column(name: "titulo", length: 255)]
    private string $titulo;

    // AUTOR
    #[Assert\NotNull(message: "Debe seleccionar un autor.")]
    #[ORM\ManyToOne(targetEntity: Autor::class)]
    #[ORM\JoinColumn(name: "id_autor", referencedColumnName: "id_autor", nullable: false)]
    private ?Autor $autor = null;

    // ISBN
    #[Assert\Length(
        min: 10,
        max: 13,
        minMessage: "El ISBN debe tener al menos {{ limit }} dígitos.",
        maxMessage: "El ISBN no puede superar los {{ limit }} dígitos."
    )]
    #[Assert\Regex(
        pattern: "/^[0-9]+$/",
        message: "El ISBN solo debe contener números."
    )]
    #[ORM\Column(name: "isbn", length: 20, nullable: true, unique: true)]
    private ?string $isbn = null;

    // 🔥 EDITORIAL: RELACIÓN REAL — NO STRING
    #[Assert\NotNull(message: "Debe seleccionar una editorial.")]
    #[ORM\ManyToOne(targetEntity: Editorial::class)]
    #[ORM\JoinColumn(name: "id_editorial", referencedColumnName: "id_editorial", nullable: false)]
    private ?Editorial $editorial = null;

    // AÑO
    #[Assert\Range(
        min: 1500,
        max: 2030,
        notInRangeMessage: "El año debe estar entre {{ min }} y {{ max }}."
    )]
    #[ORM\Column(name: "anio_publicacion", type: "integer", nullable: true)]
    private ?int $anioPublicacion = null;

    // CATEGORÍA
    #[ORM\ManyToOne(targetEntity: Categoria::class)]
    #[ORM\JoinColumn(name: "id_categoria", referencedColumnName: "id_categoria", nullable: true)]
    private ?Categoria $categoria = null;

    // GETTERS Y SETTERS

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;
        return $this;
    }

    public function getAutor(): ?Autor
    {
        return $this->autor;
    }

    public function setAutor(?Autor $autor): static
    {
        $this->autor = $autor;
        return $this;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(?string $isbn): static
    {
        $this->isbn = $isbn;
        return $this;
    }

    // ⭐ Nuevo getter y setter para Editorial (sin tocar nada más)
    public function getEditorial(): ?Editorial
    {
        return $this->editorial;
    }

    public function setEditorial(?Editorial $editorial): static
    {
        $this->editorial = $editorial;
        return $this;
    }

    public function getAnioPublicacion(): ?int
    {
        return $this->anioPublicacion;
    }

    public function setAnioPublicacion(?int $anioPublicacion): static
    {
        $this->anioPublicacion = $anioPublicacion;
        return $this;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): static
    {
        $this->categoria = $categoria;
        return $this;
    }
}
