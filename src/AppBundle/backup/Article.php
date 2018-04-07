<?php
/**
 * Created by PhpStorm.
 * User: FIRAS
 * Date: 27/01/2018
 * Time: 12:35
 */

namespace AppBundle\backup;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\Validator\Constraints\Type;


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
     * @ORM\Column(type="string", nullable=true)
     * @Type("string")
     */
    private $categorie;


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
     * One Product has Many Features.
     * @OneToMany(targetEntity="AppBundle\Entity\Images", mappedBy="article")
     */
    private $images;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->avis = new \Doctrine\Common\Collections\ArrayCollection();
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Article
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

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
     * Get images
     *
     * @return string
     */
    public function getImages()
    {
        return $this->images;
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
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
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
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
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
     * Get datePub
     *
     * @return \DateTime
     */
    public function getDatePub()
    {
        return $this->date_pub;
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
     * Get oldprix
     *
     * @return float
     */
    public function getOldprix()
    {
        return $this->oldprix;
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
}
