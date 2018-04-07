<?php
/**
 * Created by PhpStorm.
 * User: FIRAS
 * Date: 27/01/2018
 * Time: 15:54
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;
use Symfony\Component\Validator\Constraints\Type;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MessageRepository")
 */
class Message
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
    private $message;


    /**
     * One Product has One Shipment.
     * @OneToOne(targetEntity="AppBundle\Entity\User")
     * @JoinColumn(name="sender_id", referencedColumnName="id",onDelete="CASCADE")
     */
    private $sender;

    /**
     * One Product has One Shipment.
     * @OneToOne(targetEntity="AppBundle\Entity\User")
     * @JoinColumn(name="reciever_id", referencedColumnName="id",onDelete="CASCADE")
     */
    private $receiver;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @Type("datetime")
     */
    private $date;


    /**
     * Many Features have One Product.
     * @ManyToOne(targetEntity="AppBundle\Entity\Conversation", inversedBy="messages")
     * @JoinColumn(name="conversation_id", referencedColumnName="id",onDelete="CASCADE")
     */
    private $conversation;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     * @Type("boolean")
     */
    private $vu;


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
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Message
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get vu
     *
     * @return boolean
     */
    public function getVu()
    {
        return $this->vu;
    }

    /**
     * Set vu
     *
     * @param boolean $vu
     *
     * @return Message
     */
    public function setVu($vu)
    {
        $this->vu = $vu;

        return $this;
    }

    /**
     * Get sender
     *
     * @return \AppBundle\Entity\User
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set sender
     *
     * @param \AppBundle\Entity\User $sender
     *
     * @return Message
     */
    public function setSender(\AppBundle\Entity\User $sender = null)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get reciever
     *
     * @return \AppBundle\Entity\User
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set reciever
     *
     * @param \AppBundle\Entity\User $receiver
     *
     * @return Message
     */
    public function setReceiver(\AppBundle\Entity\User $receiver = null)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get conversation
     *
     * @return \AppBundle\Entity\Conversation
     */
    public function getConversation()
    {
        return $this->conversation;
    }

    /**
     * Set conversation
     *
     * @param \AppBundle\Entity\Conversation $conversation
     *
     * @return Message
     */
    public function setConversation(\AppBundle\Entity\Conversation $conversation = null)
    {
        $this->conversation = $conversation;

        return $this;
    }
}
