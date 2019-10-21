<?php
/**
 * Created by PhpStorm.
 * User: FIRAS
 * Date: 27/01/2018
 * Time: 15:50
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use Symfony\Component\Validator\Constraints\Type;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReclamationRepository")
 */
class Reclamation
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
     * @OneToOne(targetEntity="AppBundle\Entity\Acheteur")
     * @JoinColumn(name="acheteur_id", referencedColumnName="id")
     */
    private $acheteur;
    /**
     * One Product has One Shipment.
     * @OneToOne(targetEntity="AppBundle\Entity\Article")
     * @JoinColumn(name="article_id", referencedColumnName="id")
     */
    private $article;


    /**
     * @ORM\Column(type="text", nullable=true)
     * @Type("string")
     */
    private $reclamation;

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
     * Set reclamation
     *
     * @param string $reclamation
     *
     * @return Reclamation
     */
    public function setReclamation($reclamation)
    {
        $this->reclamation = $reclamation;

        return $this;
    }

    /**
     * Get reclamation
     *
     * @return string
     */
    public function getReclamation()
    {
        return $this->reclamation;
    }

    /**
     * Set acheteur
     *
     * @param \AppBundle\Entity\Acheteur $acheteur
     *
     * @return Reclamation
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
     * @return Reclamation
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
}
