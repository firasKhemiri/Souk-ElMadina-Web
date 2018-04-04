<?php
/**
 * Created by PhpStorm.
 * User: FIRAS
 * Date: 27/01/2018
 * Time: 12:33
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Type;

/**
 * Vendeur
 *
 * @ORM\Table(name="vendeur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VendeurRepository")
 */
class Vendeur
{

    /**
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * One Product has One Shipment.
     * @OneToOne(targetEntity="AppBundle\Entity\User")
     * @JoinColumn(name="user_id", referencedColumnName="id",onDelete="CASCADE")
     *
     */
    private $user;


    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     *
     * @Assert\NotBlank(message="Entrez votre nom.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max="255",
     *     minMessage="prenom trop court.",
     *     maxMessage="prenom trop long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $nom_boutique;


    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    protected $description;

    /**
     * Many Groups have Many Users.
     * @ManyToMany(targetEntity="AppBundle\Entity\Acheteur", mappedBy="vendeur")
     */
    private $abonnes;

    /**
     * One Product has Many Features.
     * @OneToMany(targetEntity="AppBundle\Entity\Article", mappedBy="vendeur")
     */
    private $articles;




    /**
     * @ORM\Column(type="string", nullable=true)
     * @Type("int")
     */
    private $note;

    /**
     * Add article
     *
     * @param \AppBundle\Entity\Commande $article
     *
     * @return Vendeur
     */
    public function addArticle(\AppBundle\Entity\Commande $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \AppBundle\Entity\Commande $article
     */
    public function removeArticle(\AppBundle\Entity\Commande $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Add abonne
     *
     * @param \AppBundle\Entity\Acheteur $abonne
     *
     * @return Vendeur
     */
    public function addAbonne(\AppBundle\Entity\Acheteur $abonne)
    {
        $this->abonnes[] = $abonne;

        return $this;
    }

    /**
     * Remove abonne
     *
     * @param \AppBundle\Entity\Acheteur $abonne
     */
    public function removeAbonne(\AppBundle\Entity\Acheteur $abonne)
    {
        $this->abonnes->removeElement($abonne);
    }

    /**
     * Get abonnes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAbonnes()
    {
        return $this->abonnes;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->abonnes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Vendeur
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
     * Set note
     *
     * @param string $note
     *
     * @return Vendeur
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Vendeur
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Vendeur
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
     * @return Vendeur
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Vendeur
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
     * Set nomBoutique
     *
     * @param string $nomBoutique
     *
     * @return Vendeur
     */
    public function setNomBoutique($nomBoutique)
    {
        $this->nom_boutique = $nomBoutique;

        return $this;
    }

    /**
     * Get nomBoutique
     *
     * @return string
     */
    public function getNomBoutique()
    {
        return $this->nom_boutique;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Vendeur
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
     * @return Vendeur
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
     * @return Vendeur
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
     * Set usertype
     *
     * @param string $usertype
     *
     * @return Vendeur
     */
    public function setUsertype($usertype)
    {
        $this->usertype = $usertype;

        return $this;
    }

    /**
     * Get usertype
     *
     * @return string
     */
    public function getUsertype()
    {
        return $this->usertype;
    }

    /**
     * Set facebookId
     *
     * @param string $facebookId
     *
     * @return Vendeur
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
     * @return Vendeur
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
     * Set id
     *
     * @param \AppBundle\Entity\User $id
     *
     * @return Vendeur
     */
    public function setId(\AppBundle\Entity\User $id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Vendeur
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
