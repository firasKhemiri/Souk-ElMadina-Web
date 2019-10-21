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
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * Acheteur
 *
 * @ORM\Table(name="acheteur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AcheteurRepository")
 */
class Acheteur extends User
{


    /**
     * Many Users have Many Groups.
     * @ManyToMany(targetEntity="AppBundle\Entity\Vendeur", inversedBy="acheteurs")
     * @JoinTable(name="abonnements")
     */
    private $abonnements;

    /**
     *
     * One Product has Many Features.
     * @OneToMany(targetEntity="Commande", mappedBy="acheteur")
     */
    private $cmd;


    /**
     * Many Users have Many Groups.
     * @ManyToMany(targetEntity="Enchere", inversedBy="users")
     * @JoinTable(name="acheteurs_encheres")
     */
    private $encheres;


    /**
     * Many Users have Many Groups.
     * @ManyToMany(targetEntity="AppBundle\Entity\Article")
     * @JoinTable(name="acheteurs_watchlists",
     *      joinColumns={@JoinColumn(name="acheteur_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="article_id", referencedColumnName="id")}
     *      )
     */
    private $watchlist;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->abonnements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cmd = new \Doctrine\Common\Collections\ArrayCollection();
        $this->encheres = new \Doctrine\Common\Collections\ArrayCollection();
        $this->watchlist = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add cmd
     *
     * @param \AppBundle\Entity\Commande $cmd
     *
     * @return Acheteur
     */
    public function addCmd(\AppBundle\Entity\Commande $cmd)
    {
        $this->cmd[] = $cmd;

        return $this;
    }

    /**
     * Remove cmd
     *
     * @param \AppBundle\Entity\Commande $cmd
     */
    public function removeCmd(\AppBundle\Entity\Commande $cmd)
    {
        $this->cmd->removeElement($cmd);
    }

    /**
     * Get cmd
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCmd()
    {
        return $this->cmd;
    }

    /**
     * Add enchere
     *
     * @param \AppBundle\Entity\Enchere $enchere
     *
     * @return Acheteur
     */
    public function addEnchere(\AppBundle\Entity\Enchere $enchere)
    {
        $this->encheres[] = $enchere;

        return $this;
    }

    /**
     * Remove enchere
     *
     * @param \AppBundle\Entity\Enchere $enchere
     */
    public function removeEnchere(\AppBundle\Entity\Enchere $enchere)
    {
        $this->encheres->removeElement($enchere);
    }

    /**
     * Get encheres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEncheres()
    {
        return $this->encheres;
    }

    /**
     * Add abonnement
     *
     * @param \AppBundle\Entity\Vendeur $abonnement
     *
     * @return Acheteur
     */
    public function addAbonnement(\AppBundle\Entity\Vendeur $abonnement)
    {
        $this->abonnements[] = $abonnement;

        return $this;
    }

    /**
     * Remove abonnement
     *
     * @param \AppBundle\Entity\Vendeur $abonnement
     */
    public function removeAbonnement(\AppBundle\Entity\Vendeur $abonnement)
    {
        $this->abonnements->removeElement($abonnement);
    }

    /**
     * Get abonnements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAbonnements()
    {
        return $this->abonnements;
    }

    /**
     * Add watchlist
     *
     * @param \AppBundle\Entity\Article $watchlist
     *
     * @return Acheteur
     */
    public function addWatchlist(\AppBundle\Entity\Article $watchlist)
    {
        $this->watchlist[] = $watchlist;

        return $this;
    }

    /**
     * Remove watchlist
     *
     * @param \AppBundle\Entity\Article $watchlist
     */
    public function removeWatchlist(\AppBundle\Entity\Article $watchlist)
    {
        $this->watchlist->removeElement($watchlist);
    }

    /**
     * Get watchlist
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWatchlist()
    {
        return $this->watchlist;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Acheteur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Acheteur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Acheteur
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Acheteur
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Acheteur
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return Acheteur
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Acheteur
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set facebookId
     *
     * @param string $facebookId
     *
     * @return Acheteur
     */
    public function setFacebookId($facebookId)
    {
        $this->facebook_id = $facebookId;

        return $this;
    }

    /**
     * Get facebookId
     *
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebook_id;
    }

    /**
     * Set facebookAccessToken
     *
     * @param string $facebookAccessToken
     *
     * @return Acheteur
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebook_access_token = $facebookAccessToken;

        return $this;
    }

    /**
     * Get facebookAccessToken
     *
     * @return string
     */
    public function getFacebookAccessToken()
    {
        return $this->facebook_access_token;
    }
}
