<?php
/**
 * Created by PhpStorm.
 * User: FIRAS
 * Date: 27/01/2018
 * Time: 22:50
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Validator\Constraints\Type;

/**
 * Images
 *
 * @ORM\Table(name="images")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ImagesRepository")
 */
class Images
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
    private $url;

    /**
     * Many Features have One Product.
     * @ManyToOne(targetEntity="AppBundle\Entity\Article", inversedBy="images")
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
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Images
     */
    public function setUrl($url)
    {
        $this->url = $url;

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
     * Set article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return Images
     */
    public function setArticle(\AppBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }
}
