<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection as Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tema
 *
 * @ORM\Table(name="tema")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TemaRepository")
 */
class Tema
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Commentario", mappedBy="tema")
     */
    private $comentarios;

    /**
     * @Gedmo\Slug(fields={"titulo"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @var int
     *
     * @ORM\Column(name="click", type="integer", nullable=true)
     */
    private $click;

    public function __construct() {
        $this->comentarios = new ArrayCollection();
    }

    public function addComentario(Commentario $comentario) {
        $this->comentarios[] = $comentario;
        $comentario->setTema($this);
    }

    /**
     *  @return Collection|Commentario[]
     *  @param Doctrine\Common\Collections\Collection
     *
     */
    public function getComentarios(): Collection
    {
        return $this->comentarios;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Tema
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Tema
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

      public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return int
     */
    public function getClick()
    {
        return $this->click;
    }

    /**
     * @param int $click
     */
    public function setClick($click)
    {
        $this->click = $click;
    }

    /**
     * @return Tema
     */
    public function addClick()
    {
        if(isset($this->click))
            $this->click = $this->click + 1;
        else
            $this->click = 1;

        return $this;
    }

    public function __toString()
    {
        return $this->getTitulo();
    }

}

