<?php
/**
 * Created by PhpStorm.
 * User: FIRAS
 * Date: 27/01/2018
 * Time: 14:43
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Validator\Constraints\Type;


/**
 * Acheteur
 *
 * @ORM\Table(name="avis")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AvisRepository")
 */
class Avis
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
     * @ORM\Column(type="datetime", nullable=false)
     * @Type("datetime")
     */
    private $date_pub;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Type("int")
     */
    private $note;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Type("string")
     */
    private $avis;


    /**
     * Many Features have One Product.
     * @ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="avis")
     * @JoinColumn(name="user_id", referencedColumnName="id",onDelete="CASCADE")
     */
    private $user;



    /**
     * Many Features have One Product.
     * @ManyToOne(targetEntity="AppBundle\Entity\Article", inversedBy="avis")
     * @JoinColumn(name="article_id", referencedColumnName="id",onDelete="CASCADE")
     */
    private $article;




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
     * Set note
     *
     * @param string $note
     *
     * @return Avis
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
     * Set acheteur
     *
     * @param \AppBundle\Entity\Acheteur $acheteur
     *
     * @return Avis
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
     * Set article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return Avis
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
     * @ORM\PrePersist
     */
    public function doStuffOnPrePersist()
    {
        $this->date_pub = new \DateTimeImmutable();
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
     * Set avis
     *
     * @param string $avis
     *
     * @return Avis
     */
    public function setAvis($avis)
    {
        $this->avis = $avis;

        return $this;
    }

    /**
     * Get avis
     *
     * @return string
     */
    public function getAvis()
    {
        return $this->avis;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Avis
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

    /**
     * Set datePub
     *
     * @param \DateTime $datePub
     *
     * @return Avis
     */
    public function setDatePub($datePub)
    {
        $this->date_pub = $datePub;

        return $this;
    }
}
