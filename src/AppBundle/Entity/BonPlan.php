<?php
/**
 * Created by PhpStorm.
 * User: FIRAS
 * Date: 27/01/2018
 * Time: 15:56
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Symfony\Component\Validator\Constraints\Type;


/**
 * Bonplan
 *
 * @ORM\Table(name="bon_plan")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BonPlanRepository")
 */
class BonPlan
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
     * Many Users have Many Groups.
     * @ManyToMany(targetEntity="AppBundle\Entity\Article")
     * @JoinTable(name="bonplan_articles",
     *      joinColumns={@JoinColumn(name="bonplan_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="article_id", referencedColumnName="id")}
     *      )
     */
    private $articles;


    /**
     * @ORM\Column(type="string")
     * @Type("string")
     */
    private $type;

    /**
     * @ORM\Column(type="string")
     * @Type("string")
     */
    private $offre;


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
     * Constructor
     */
    public function __construct()
    {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return BonPlan
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get offre
     *
     * @return string
     */
    public function getOffre()
    {
        return $this->offre;
    }

    /**
     * Set offre
     *
     * @param string $offre
     *
     * @return BonPlan
     */
    public function setOffre($offre)
    {
        $this->offre = $offre;

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
     * Set dateDeb
     *
     * @param \DateTime $dateDeb
     *
     * @return BonPlan
     */
    public function setDateDeb($dateDeb)
    {
        $this->date_deb = $dateDeb;

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

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return BonPlan
     */
    public function setDateFin($dateFin)
    {
        $this->date_fin = $dateFin;

        return $this;
    }

    /**
     * Add article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return BonPlan
     */
    public function addArticle(\AppBundle\Entity\Article $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \AppBundle\Entity\Article $article
     */
    public function removeArticle(\AppBundle\Entity\Article $article)
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
}
