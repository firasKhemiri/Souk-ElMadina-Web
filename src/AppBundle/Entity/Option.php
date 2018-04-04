<?php
/**
 * Created by PhpStorm.
 * User: FIRAS
 * Date: 26/03/2018
 * Time: 20:53
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;
use Symfony\Component\Validator\Constraints\Type;


/**
 * Option
 *
 * @ORM\Table(name="option")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OptionRepository")
 */
class Option
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
     * Many Features have One Product.
     * @ManyToOne(targetEntity="AppBundle\Entity\Article", inversedBy="option")
     * @JoinColumn(name="article_id", referencedColumnName="id",onDelete="CASCADE")
     */
    private $article;


    /**
     * @ORM\Column(type="string", nullable=false)
     * @Type("string")
     */
    private $type;


    /**
     * @ORM\Column(type="string", nullable=false)
     * @Type("string")
     */
    private $nom;




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
     * @return Option
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
     * Set type
     *
     * @param string $type
     *
     * @return Option
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
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
     * Set article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return Option
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
