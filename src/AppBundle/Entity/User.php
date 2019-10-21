<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use FOS\MessageBundle\Model\ParticipantInterface;
use Symfony\Component\Validator\Constraints\Type;


/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser implements ParticipantInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /** @ORM\Column(name="facebook_id", type="string", length=255, nullable=true) */
    protected $facebook_id;
    /** @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true) */
    protected $facebook_access_token;


    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     *
     */
    protected $nom;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     *
     */
    protected $prenom;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Type("string")
     */
    protected $state;
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Type("string")
     */
    protected $ville;
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Type("string")
     */
    protected $adresse;


    /**
     * @var string $photoProf
     * @ORM\Column(type="string", nullable=true)
     * @Type("string")
     */
    protected $photoProf;

    /**
     * @var string $gender
     * @ORM\Column(type="string", nullable=true)
     * @Type("string")
     */
    protected $gender;


    /**
     * @var string $phone
     * @ORM\Column(type="string", nullable=true)
     * @Type("string")
     */
    protected $phone;


    /**
     * @var string $birthday
     * @ORM\Column(type="datetime", nullable=true)
     * @Type("datetime")
     */
    protected $birthday;


    /**
     * @var string $panier
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Panier")
     */
    protected $panier;


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
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return User
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get photoProf
     *
     * @return string
     */
    public function getPhotoProf()
    {
        return $this->photoProf;
    }

    /**
     * Set photoProf
     *
     * @param string $photoProf
     *
     * @return User
     */
    public function setPhotoProf($photoProf)
    {
        $this->photoProf = $photoProf;

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
     * Set state
     *
     * @param string $state
     *
     * @return User
     */
    public function setState($state)
    {
        $this->state = $state;

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
     * Set ville
     *
     * @param string $ville
     *
     * @return User
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

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
     * Set gender
     *
     * @param string $gender
     *
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

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
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return User
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

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
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

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
     * Set facebookId
     *
     * @param string $facebookId
     *
     * @return User
     */
    public function setFacebookId($facebookId)
    {
        $this->facebook_id = $facebookId;

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
     * Set facebookAccessToken
     *
     * @param string $facebookAccessToken
     *
     * @return User
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebook_access_token = $facebookAccessToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getPanier()
    {
        return $this->panier;
    }

    /**
     * @param string $panier
     */
    public function setPanier($panier)
    {
        $this->panier = $panier;
    }


}
