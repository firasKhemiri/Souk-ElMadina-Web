<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ligne
 *
 * @ORM\Table(name="ligne")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LigneRepository")
 */
class Ligne
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
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Panier", inversedBy="lignes",cascade={"persist"})
     * @ORM\JoinColumn(name="panier", referencedColumnName="id")
     *
     */
    private $panier;
    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Article", inversedBy="lignes",cascade={"persist"})
     * @ORM\JoinColumn(name="article", referencedColumnName="id")
     */
    private $article;
    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer" , nullable=true)
     */
    private $quantite;

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
     * @return mixed
     */
    public function getPanier()
    {
        return $this->panier;
    }

    /**
     * @param null $panier
     * @return $this
     */
    public function setPanier($panier = null)
    {
        $this->panier = $panier;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param null $article
     * @return $this
     */
    public function setArticle($article = null)
    {
        $this->article = $article;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param int $quantite
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }
}

