<?php
/**
 * Created by PhpStorm.
 * User: FIRAS
 * Date: 27/01/2018
 * Time: 15:55
 */

namespace AppBundle\Entity;



use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use Symfony\Component\Validator\Constraints\Type;

/**
 * Vendeur
 *
 * @ORM\Table(name="publicity")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublicityRepository")
 */
class Publicity
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
     * @OneToOne(targetEntity="AppBundle\Entity\Article")
     * @JoinColumn(name="article_id", referencedColumnName="id",nullable=true)
     */
    private $article;


    /**
     * One Product has One Shipment.
     * @OneToOne(targetEntity="AppBundle\Entity\Vendeur")
     * @JoinColumn(name="vendeur_id", referencedColumnName="id",nullable=true)
     */
    private $vendeur;


    /**
     * @ORM\Column(type="string")
     * @Type("string")
     */
    private $pub_type;


    /**
     * @ORM\Column(type="string")
     * @Type("string")
     */
    private $image_url;



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
     * @return Publicity
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
     * Set pubType
     *
     * @param string $pubType
     *
     * @return Publicity
     */
    public function setPubType($pubType)
    {
        $this->pub_type = $pubType;

        return $this;
    }

    /**
     * Get pubType
     *
     * @return string
     */
    public function getPubType()
    {
        return $this->pub_type;
    }

    /**
     * Set imageUrl
     *
     * @param string $imageUrl
     *
     * @return Publicity
     */
    public function setImageUrl($imageUrl)
    {
        $this->image_url = $imageUrl;

        return $this;
    }

    /**
     * Get imageUrl
     *
     * @return string
     */
    public function getImageUrl()
    {
        return $this->image_url;
    }

    /**
     * Set vendeur
     *
     * @param \AppBundle\Entity\Vendeur $vendeur
     *
     * @return Publicity
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
     * Set dateDeb
     *
     * @param \DateTime $dateDeb
     *
     * @return Publicity
     */
    public function setDateDeb($dateDeb)
    {
        $this->date_deb = $dateDeb;

        return $this;
    }

    /**
     * Get dateDeb
     *
     * @return \DateTime
     */
    public function getDateDeb()
    {
        return $this->date_deb;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Publicity
     */
    public function setDateFin($dateFin)
    {
        $this->date_fin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->date_fin;
    }
}
