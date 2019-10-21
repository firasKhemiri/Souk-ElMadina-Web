<?php
/**
 * Created by PhpStorm.
 * User: FIRAS
 * Date: 10/02/2018
 * Time: 16:44
 */

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;


/**
 * Panier
 *
 * @ORM\Table(name="panier")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PanierRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Panier
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
     * @var DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime" , nullable=true)
     */
    private $date_creation;
    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_facturation", type="datetime" , nullable=true)
     */
    private $date_facturation;
    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float" , nullable=true)
     */
    private $montant;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ligne", mappedBy="panier",cascade={"persist"})
     */
    private $lignes;

    public function __construct()
    {
        $this->lignes = new ArrayCollection();
    }

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
     * @return DateTime
     */
    public function getDateCreation()
    {
        return $this->date_creation;
    }

    /**
     * @param DateTime $date_creation
     */
    public function setDateCreation($date_creation)
    {
        $this->date_creation = $date_creation;
    }

    /**
     * @return DateTime
     */
    public function getDateFacturation()
    {
        return $this->date_facturation;
    }

    /**
     * @param DateTime $date_facturation
     */
    public function setDateFacturation($date_facturation)
    {
        $this->date_facturation = $date_facturation;
    }

    /**
     * @return float
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * @param float $montant
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Add user_recipe_associations
     *
     * @param Ligne $ligne
     * @return Panier
     */
    public function addUserRecipeAssociation(Ligne $ligne)
    {
        $this->lignes[] = $ligne;
        return $this;
    }

    /**
     * Remove ligne
     *
     * @param Ligne $ligne
     */
    public function removeUserRecipeAssociation(Ligne $ligne)
    {
        $this->lignes->removeElement($ligne);
    }

    /**
     * Get lignes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserRecipeAssociations()
    {
        return $this->lignes;
    }

    /**
     * @ORM\PrePersist
     */
    public function onPrePersistSetRegistrationDate()
    {
        $this->date_creation = new \DateTime();
    }
}
