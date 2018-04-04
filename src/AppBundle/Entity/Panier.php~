<?php
/**
 * Created by PhpStorm.
 * User: FIRAS
 * Date: 10/02/2018
 * Time: 16:44
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints\Type;


/**
 * Acheteur
 *
 * @ORM\Table(name="panier")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PanierRepository")
 */
class Panier
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
     * One Product has One Shipment.
     * @OneToOne(targetEntity="AppBundle\Entity\User")
     * @JoinColumn(name="user_id", referencedColumnName="id",unique=true,onDelete="CASCADE")
     */
    private $user;

    /**
     * Many User have Many Phonenumbers.
     * @ManyToMany(targetEntity="AppBundle\Entity\Article")
     * @JoinTable(name="panier_articles",
     *      joinColumns={@JoinColumn(name="panier_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="article_id", referencedColumnName="id")}
     *      )
     */
    private $article;



    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Type("datetime")
     */
    private $date_modif;

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
     * Set dateModif
     *
     * @param \DateTime $dateModif
     *
     * @return Panier
     */
    public function setDateModif($dateModif)
    {
        $this->date_modif = $dateModif;

        return $this;
    }

    /**
     * Get dateModif
     *
     * @return \DateTime
     */
    public function getDateModif()
    {
        return $this->date_modif;
    }

    /**
     * Set acheteur
     *
     * @param \AppBundle\Entity\Acheteur $acheteur
     *
     * @return Panier
     */
    public function setAcheteur(\AppBundle\Entity\Acheteur $acheteur = null)
    {
        $this->acheteur = $acheteur;

        return $this;
    }

    /**
     * Get acheteur
     *
     * @return \AppBundle\Entity\Acheteur
     */
    public function getAcheteur()
    {
        return $this->acheteur;
    }

    /**
     * Add article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return Panier
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
     * Get article
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Panier
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
