<?php
/**
 * Created by PhpStorm.
 * User: FIRAS
 * Date: 27/01/2018
 * Time: 14:49
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToOne;
use Symfony\Component\Validator\Constraints\Type;

use Doctrine\ORM\Mapping as ORM;

/**
 * Enchere
 *
 * @ORM\Table(name="enchere")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EnchereRepository")
 */
class Enchere
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
     * Many Groups have Many Users.
     * @ManyToMany(targetEntity="Acheteur", mappedBy="encheres")
     */
    private $acheteurs;

    /**
     * One Product has One Shipment.
     * @OneToOne(targetEntity="Article")
     * @JoinColumn(name="article_id", referencedColumnName="id",onDelete="CASCADE")
     */
    private $article;


    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Type("datetime")
     */
    private $date_deb;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Type("datetime")
     */
    private $date_fin;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Type("float")
     */
    private $prix_actuel;
    /**
     * Constructor
     */

    /**
     * One Product has One Shipment.
     * @OneToOne(targetEntity="AppBundle\Entity\Acheteur")
     * @JoinColumn(name="winner_id", referencedColumnName="id")
     */
    private $winner;


    public function __construct()
    {
        $this->acheteurs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set dateDeb
     *
     * @param \Date $dateDeb
     *
     * @return Enchere
     */
    public function setDateDeb(\Date $dateDeb)
    {
        $this->date_deb = $dateDeb;

        return $this;
    }

    /**
     * Get dateDeb
     *
     * @return \Date
     */
    public function getDateDeb()
    {
        return $this->date_deb;
    }

    /**
     * Set dateFin
     *
     * @param \Date $dateFin
     *
     * @return Enchere
     */
    public function setDateFin(\Date $dateFin)
    {
        $this->date_fin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \Date
     */
    public function getDateFin()
    {
        return $this->date_fin;
    }

    /**
     * Set prixActuel
     *
     * @param float $prixActuel
     *
     * @return Enchere
     */
    public function setPrixActuel($prixActuel)
    {
        $this->prix_actuel = $prixActuel;

        return $this;
    }

    /**
     * Get prixActuel
     *
     * @return float
     */
    public function getPrixActuel()
    {
        return $this->prix_actuel;
    }

    /**
     * Add acheteur
     *
     * @param \AppBundle\Entity\Acheteur $acheteur
     *
     * @return Enchere
     */
    public function addAcheteur(\AppBundle\Entity\Acheteur $acheteur)
    {
        $this->acheteurs[] = $acheteur;

        return $this;
    }

    /**
     * Remove acheteur
     *
     * @param \AppBundle\Entity\Acheteur $acheteur
     */
    public function removeAcheteur(\AppBundle\Entity\Acheteur $acheteur)
    {
        $this->acheteurs->removeElement($acheteur);
    }

    /**
     * Get acheteurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAcheteurs()
    {
        return $this->acheteurs;
    }

    /**
     * Set article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return Enchere
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
     * Set winner
     *
     * @param \AppBundle\Entity\Acheteur $winner
     *
     * @return Enchere
     */
    public function setWinner(\AppBundle\Entity\Acheteur $winner = null)
    {
        $this->winner = $winner;

        return $this;
    }

    /**
     * Get winner
     *
     * @return \AppBundle\Entity\Acheteur
     */
    public function getWinner()
    {
        return $this->winner;
    }
}
