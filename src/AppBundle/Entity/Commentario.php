<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentario
 *
 * @ORM\Table(name="commentario")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentarioRepository")
 * @ORM\HasLifecycleCallbacks()
 *
 */
class Commentario
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
     * @ORM\Column(name="opinion", type="text")
     */
    private $opinion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var string
     *
     * @ORM\Column(name="host", type="string", length=255)
     */
    private $host;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tema", inversedBy="comentarios")
     */
    private $tema;

    public function getTema(): ?Tema
    {
        return $this->tema;
    }

    public function setTema(Tema $tema): self
    {
        $this->tema = $tema;

        return $this;
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
     * Set opinion
     *
     * @param string $opinion
     *
     * @return Commentario
     */
    public function setOpinion($opinion)
    {
        $this->opinion = $opinion;

        return $this;
    }

    /**
     * Get opinion
     *
     * @return string
     */
    public function getOpinion()
    {
        return $this->opinion;
    }

//    /**
//     * Set created
//     *
//     * @param \DateTime $created
//     *
//     * @return Commentario
//     */
//    public function setCreated($created)
//    {
//        $this->created = $created;
//
//        return $this;
//    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->created = new \DateTime();
    }

    /**
     * Set host
     *
     * @param string $host
     *
     * @return Commentario
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get host
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }
}

