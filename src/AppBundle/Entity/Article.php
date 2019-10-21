<?php
/**
 * Created by PhpStorm.
 * User: FIRAS
 * Date: 27/01/2018
 * Time: 12:35
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\Validator\Constraints\Type;

use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;


/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArticleRepository")
 */
class Article
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
     * @ManyToMany(targetEntity="AppBundle\Entity\Categorie", mappedBy="article")
     */
    private $categorie;


    /**
     * Many Groups have Many Users.
     * @OneToMany(targetEntity="AppBundle\Entity\Option", mappedBy="article")
     */
    private $option;



    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @Type("datetime")
     */
    private $date_pub;


    /**
     * @ORM\Column(type="string", nullable=true)
     * @Type("string")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Type("string")
     */
    private $description;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Type("float")
     */
    private $prix;


    /**
     * @ORM\Column(type="float", nullable=true)
     * @Type("float")
     */
    private $oldprix;


    /**
     * @ORM\Column(type="string", nullable=true)
     * @Type("string")
     */
    private $ref;



    /**
     * Many Features have One Product.
     * @ManyToOne(targetEntity="AppBundle\Entity\Vendeur", inversedBy="articles")
     * @JoinColumn(name="vendeur_id", referencedColumnName="id",onDelete="CASCADE")
     */
    private $vendeur;


    /**
     * One Product has Many Features.
     * @OneToMany(targetEntity="AppBundle\Entity\Images", mappedBy="article")
     */
    private $images;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Article
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
     * Set description
     *
     * @param string $description
     *
     * @return Article
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
     * Set commande
     *
     * @param \AppBundle\Entity\Commande $commande
     *
     * @return Article
     */
    public function setCommande(\AppBundle\Entity\Commande $commande = null)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return \AppBundle\Entity\Commande
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set images
     *
     * @param string $images
     *
     * @return Article
     */
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Get images
     *
     * @return string
     */
    public function getImages()
    {
        return $this->images;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->avis = new \Doctrine\Common\Collections\ArrayCollection();
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     *
     * @return Article
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Add avi
     *
     * @param \AppBundle\Entity\Avis $avi
     *
     * @return Article
     */
    public function addAvi(\AppBundle\Entity\Avis $avi)
    {
        $this->avis[] = $avi;

        return $this;
    }

    /**
     * Remove avi
     *
     * @param \AppBundle\Entity\Avis $avi
     */
    public function removeAvi(\AppBundle\Entity\Avis $avi)
    {
        $this->avis->removeElement($avi);
    }

    /**
     * Get avis
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAvis()
    {
        return $this->avis;
    }

    /**
     * Add image
     *
     * @param \AppBundle\Entity\Images $image
     *
     * @return Article
     */
    public function addImage(\AppBundle\Entity\Images $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \AppBundle\Entity\Images $image
     */
    public function removeImage(\AppBundle\Entity\Images $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Article
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set datePub
     *
     * @param \DateTime $datePub
     *
     * @return Article
     */
    public function setDatePub($datePub)
    {
        $this->date_pub = $datePub;

        return $this;
    }

    /**
     * Get datePub
     *
     * @return \DateTime
     */
    public function getDatePub()
    {
        return $this->date_pub;
    }

    /**
     * Set oldprix
     *
     * @param float $oldprix
     *
     * @return Article
     */
    public function setOldprix($oldprix)
    {
        $this->oldprix = $oldprix;

        return $this;
    }

    /**
     * Get oldprix
     *
     * @return float
     */
    public function getOldprix()
    {
        return $this->oldprix;
    }

    /**
     * Set vendeur
     *
     * @param \AppBundle\Entity\Vendeur $vendeur
     *
     * @return Article
     */
    public function setVendeur(\AppBundle\Entity\Vendeur $vendeur = null)
    {
        $this->vendeur = $vendeur;

        return $this;
    }

    /**
     * Get vendeur
     *
     * @return \AppBundle\Entity\Vendeur
     */
    public function getVendeur()
    {
        return $this->vendeur;
    }

    /**
     * Add categorie
     *
     * @param \AppBundle\Entity\Categorie $categorie
     *
     * @return Article
     */
    public function addCategorie(\AppBundle\Entity\Categorie $categorie)
    {
        $this->categorie[] = $categorie;

        return $this;
    }

    /**
     * Remove categorie
     *
     * @param \AppBundle\Entity\Categorie $categorie
     */
    public function removeCategorie(\AppBundle\Entity\Categorie $categorie)
    {
        $this->categorie->removeElement($categorie);
    }

    /**
     * Set ref
     *
     * @param string $ref
     *
     * @return Article
     */
    public function setRef($ref)
    {
        $this->ref = $ref;

        return $this;
    }

    /**
     * Get ref
     *
     * @return string
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * Add option
     *
     * @param \AppBundle\Entity\Option $option
     *
     * @return Article
     */
    public function addOption(\AppBundle\Entity\Option $option)
    {
        $this->option[] = $option;

        return $this;
    }

    /**
     * Remove option
     *
     * @param \AppBundle\Entity\Option $option
     */
    public function removeOption(\AppBundle\Entity\Option $option)
    {
        $this->option->removeElement($option);
    }

    /**
     * Get option
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOption()
    {
        return $this->option;
    }
}
