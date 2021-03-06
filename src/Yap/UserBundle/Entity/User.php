<?php

namespace Yap\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Yap\UserBundle\Entity\UserRepository")
 * @ExclusionPolicy("all")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Yap\UserBundle\Entity\Group")
     * @ORM\JoinTable(name="fos_user_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;

    /**
    *
    * @ORM\ManyToMany(targetEntity="Yap\SpeedrunBundle\Entity\Game", cascade={"persist"})
    * @ORM\JoinTable(name="spr_subscribers_game")
    *
    */
    private $subscribers;

    /**
    *
    * @ORM\ManyToMany(targetEntity="Yap\UserBundle\Entity\User", cascade={"persist"})
    * @ORM\JoinTable(name="spr_followers_user")
    *
    */
    private $followers;

    /**
     * @var string
     *
     * @ORM\Column(name="youtube", type="string", length=255)
     */
    //private $youtube;

    /**
     * @var string
     *
     * @ORM\Column(name="twitch", type="string", length=255)
     */
    //private $twitch;


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
     * Constructor
     */
    public function __construct()
    {
		parent::__construct();
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add groups
     *
     * @param \Yap\UserBundle\Entity\Group $groups
     * @return User
     */
    public function addGroup(\FOS\UserBundle\Model\GroupInterface $groups)
    {
        $this->groups[] = $groups;

        return $this;
    }

    /**
     * Remove groups
     *
     * @param \Yap\UserBundle\Entity\Group $groups
     */
    public function removeGroup(\FOS\UserBundle\Model\GroupInterface $groups)
    {
        $this->groups->removeElement($groups);
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Add subscribers
     *
     * @param \Yap\SpeedrunBundle\Entity\Game $subscribers
     * @return User
     */
    public function addSubscriber(\Yap\SpeedrunBundle\Entity\Game $subscribers)
    {
        $this->subscribers[] = $subscribers;

        return $this;
    }

    /**
     * Remove subscribers
     *
     * @param \Yap\SpeedrunBundle\Entity\Game $subscribers
     */
    public function removeSubscriber(\Yap\SpeedrunBundle\Entity\Game $subscribers)
    {
        $this->subscribers->removeElement($subscribers);
    }

    /**
     * Get subscribers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubscribers()
    {
        return $this->subscribers;
    }

    /**
     * Add followers
     *
     * @param \Yap\UserBundle\Entity\User $followers
     * @return User
     */
    public function addFollower(\Yap\UserBundle\Entity\User $followers)
    {
        $this->followers[] = $followers;

        return $this;
    }

    /**
     * Remove followers
     *
     * @param \Yap\UserBundle\Entity\User $followers
     */
    public function removeFollower(\Yap\UserBundle\Entity\User $followers)
    {
        $this->followers->removeElement($followers);
    }

    /**
     * Get followers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFollowers()
    {
        return $this->followers;
    }
}
