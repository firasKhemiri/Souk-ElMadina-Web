<?php
/**
 * Created by PhpStorm.
 * User: FIRAS
 * Date: 27/01/2018
 * Time: 14:50
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use Symfony\Component\Validator\Constraints\Type;

/**
 * Notifications
 *
 * @ORM\Table(name="notifications")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NotificationsRepository")
 */
class Notification
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
     * @OneToOne(targetEntity="AppBundle\Entity\User")
     * @JoinColumn(name="user_id", referencedColumnName="id",nullable=false)
     */
    private $user;


    /**
     * @ORM\Column(type="string", nullable=false)
     * @Type("string")
     */
    private $message_notif;


    /**
     * @ORM\Column(type="string", nullable=false)
     * @Type("datetime")
     */
    private $type;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @Type("datetime")
     */
    private $image_url;

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
     * One Product has One Shipment.
     * @OneToOne(targetEntity="AppBundle\Entity\BonPlan")
     * @JoinColumn(name="bonplan_id", referencedColumnName="id",nullable=true)
     */
    private $bonplan;


    /**
     * One Product has One Shipment.
     * @OneToOne(targetEntity="AppBundle\Entity\Enchere")
     * @JoinColumn(name="enchere_id", referencedColumnName="id",nullable=true)
     */
    private $enchere;


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
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Notification
     */
    public function setUser(\AppBundle\Entity\User $user)
    {
        $this->user = $user;

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
     * @return Notification
     */
    public function setArticle(\AppBundle\Entity\Article $article = null)
    {
        $this->article = $article;

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
     * Set vendeur
     *
     * @param \AppBundle\Entity\Vendeur $vendeur
     *
     * @return Notification
     */
    public function setVendeur(\AppBundle\Entity\Vendeur $vendeur = null)
    {
        $this->vendeur = $vendeur;

        return $this;
    }

    /**
     * Get bonplan
     *
     * @return \AppBundle\Entity\BonPlan
     */
    public function getBonplan()
    {
        return $this->bonplan;
    }

    /**
     * Set bonplan
     *
     * @param \AppBundle\Entity\BonPlan $bonplan
     *
     * @return Notification
     */
    public function setBonplan(\AppBundle\Entity\BonPlan $bonplan = null)
    {
        $this->bonplan = $bonplan;

        return $this;
    }

    /**
     * Get enchere
     *
     * @return \AppBundle\Entity\Enchere
     */
    public function getEnchere()
    {
        return $this->enchere;
    }

    /**
     * Set enchere
     *
     * @param \AppBundle\Entity\Enchere $enchere
     *
     * @return Notification
     */
    public function setEnchere(\AppBundle\Entity\Enchere $enchere = null)
    {
        $this->enchere = $enchere;

        return $this;
    }

    /**
     * Get messageNotif
     *
     * @return string
     */
    public function getMessageNotif()
    {
        return $this->message_notif;
    }

    /**
     * Set messageNotif
     *
     * @param string $messageNotif
     *
     * @return Notification
     */
    public function setMessageNotif($messageNotif)
    {
        $this->message_notif = $messageNotif;

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
     * Set type
     *
     * @param string $type
     *
     * @return Notification
     */
    public function setType($type)
    {
        $this->type = $type;

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
     * Set imageUrl
     *
     * @param string $imageUrl
     *
     * @return Notification
     */
    public function setImageUrl($imageUrl)
    {
        $this->image_url = $imageUrl;

        return $this;
    }
}
