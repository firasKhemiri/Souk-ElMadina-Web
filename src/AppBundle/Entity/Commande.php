<?php
/**
 * Created by PhpStorm.
 * User: FIRAS
 * Date: 27/01/2018
 * Time: 12:34
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use Symfony\Component\Validator\Constraints\Type;

/**
 * Acheteur
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommandeRepository")
 */
class Commande
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
     * @ORM\Column(type="string", nullable=false)
     * @Type("string")
     */
    private $adress_liv;


    /**
     * @ORM\Column(type="string", nullable=false)
     * @Type("string")
     */
    private $meth_paiment;


    /**
     * @ORM\Column(type="string", nullable=false)
     * @Type("string")
     */
    private $meth_livraison;


    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Type("datetime")
     */
    private $date;


    /**
     * One Product has One Shipment.
     * @OneToOne(targetEntity="AppBundle\Entity\Panier")
     * @JoinColumn(name="panier_id", referencedColumnName="id",onDelete="CASCADE")
     */
    private $panier;


    /**
     * @ORM\Column(type="boolean", nullable=false)
     * @Type("boolean")
     */
    private $etat;


    /**
     * One Product has One Shipment.
     * @OneToOne(targetEntity="AppBundle\Entity\User")
     * @JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $acheteur;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->article = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return Commande
     */
    public function setArticle(\AppBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \AppBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Get acheteur
     *
     * @return \AppBundle\Entity\User
     */
    public function getAcheteur()
    {
        return $this->acheteur;
    }

    /**
     * Set acheteur
     *
     * @param \AppBundle\Entity\Acheteur $acheteur
     *
     * @return Commande
     */
    public function setAcheteur(\AppBundle\Entity\User $acheteur = null)
    {
        $this->acheteur = $acheteur;

        return $this;
    }

    /**
     * Add article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return Commande
     */
    public function addArticle(\AppBundle\Entity\Article $article)
    {
        $this->article[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \AppBundle\Entity\Article $article
     */
    public function removeArticle(\AppBundle\Entity\Article $article)
    {
        $this->article->removeElement($article);
    }

    /**
     * Get adressLiv
     *
     * @return string
     */
    public function getadress_liv()
    {
        return $this->adress_liv;
    }

    /**
     * Set adressLiv
     *
     * @param string $adressLiv
     *
     * @return Commande
     */
    public function setAdressLiv($adressLiv)
    {
        $this->adress_liv = $adressLiv;

        return $this;
    }

    /**
     * Get methPaiment
     *
     * @return string
     */
    public function getmeth_paiment()
    {
        return $this->meth_paiment;
    }

    /**
     * Get methPaiment
     *
     * @return string
     */
    public function getmethPaiment()
    {
        return $this->meth_paiment;
    }

    /**
     * Set methPaiment
     *
     * @param string $methPaiment
     *
     * @return Commande
     */
    public function setMethPaiment($methPaiment)
    {
        $this->meth_paiment = $methPaiment;

        return $this;
    }

    /**
     * Get methLivraison
     *
     * @return string
     */
    public function getMethLivraison()
    {
        return $this->meth_livraison;
    }

    /**
     * Set methLivraison
     *
     * @param string $methLivraison
     *
     * @return Commande
     */
    public function setMethLivraison($methLivraison)
    {
        $this->meth_livraison = $methLivraison;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Commande
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get etat
     *
     * @return boolean
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set etat
     *
     * @param boolean $etat
     *
     * @return Commande
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get panier
     *
     * @return \AppBundle\Entity\Panier
     */
    public function getPanier()
    {
        return $this->panier;
    }

    /**
     * Set panier
     *
     * @param \AppBundle\Entity\Panier $panier
     *
     * @return Commande
     */
    public function setPanier(\AppBundle\Entity\Panier $panier = null)
    {
        $this->panier = $panier;

        return $this;
    }


    /**
     * Get adressLiv
     *
     * @return string
     */
    public function getadressLiv()
    {
        return $this->adress_liv;
    }

}
