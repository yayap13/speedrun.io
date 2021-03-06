<?php

namespace Yap\SpeedrunBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * Linker
 *
 * @ORM\Table(name="spr_linker")
 * @ORM\Entity(repositoryClass="Yap\SpeedrunBundle\Entity\LinkerRepository")
 * @ExclusionPolicy("all") 
 */
class Linker
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Expose
     */
    private $name;

    /**
    * @ORM\ManyToOne(targetEntity="Yap\SpeedrunBundle\Entity\Game", inversedBy="linkers")
    * @ORM\JoinColumn(nullable=false)
    */
    private $game;

    /**
    * @ORM\ManyToOne(targetEntity="Yap\SpeedrunBundle\Entity\Category", inversedBy="linkers")
    * @ORM\JoinColumn(nullable=false)
    */
    private $category;

    /**
    * @ORM\ManyToOne(targetEntity="Yap\SpeedrunBundle\Entity\Platform", inversedBy="linkers")
    * @ORM\JoinColumn(nullable=false)
    * @Expose
    */
    private $platform;

    /**
    * @ORM\ManyToOne(targetEntity="Yap\SpeedrunBundle\Entity\Difficulty")
    * @ORM\JoinColumn(nullable=false)
    */
    private $difficulty;

    /**
    * @var boolean
    *
    * @ORM\Column(name="scripted", type="boolean")
    */
    private $scripted;

    /**
    * @var boolean
    *
    * @ORM\Column(name="segmented", type="boolean")
    */
    private $segmented;

    /**
    * @var boolean
    *
    * @ORM\Column(name="tas", type="boolean")
    */
    private $tas;

    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=255, nullable=true)
     */
    private $version;

    /**
    * @ORM\OneToMany(targetEntity="Yap\SpeedrunBundle\Entity\Time", mappedBy="linker", cascade={"persist"})
    */
    private $times;


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
     * Set game
     *
     * @param \Yap\SpeedrunBundle\Entity\Game $game
     * @return Linker
     */
    public function setGame(\Yap\SpeedrunBundle\Entity\Game $game)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return \Yap\SpeedrunBundle\Entity\Game 
     */
    public function getGame()
    {
        return $this->game;
    }

   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->times = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add times
     *
     * @param \Yap\SpeedrunBundle\Entity\Time $times
     * @return Linker
     */
    public function addTime(\Yap\SpeedrunBundle\Entity\Time $times)
    {
        $this->times[] = $times;

        return $this;
    }

    /**
     * Remove times
     *
     * @param \Yap\SpeedrunBundle\Entity\Time $times
     */
    public function removeTime(\Yap\SpeedrunBundle\Entity\Time $times)
    {
        $this->times->removeElement($times);
    }

    /**
     * Get times
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTimes()
    {
        return $this->times;
    }

    /**
     * Set category
     *
     * @param \Yap\SpeedrunBundle\Entity\Category $category
     * @return Linker
     */
    public function setCategory(\Yap\SpeedrunBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Yap\SpeedrunBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set platform
     *
     * @param \Yap\SpeedrunBundle\Entity\Platform $platform
     * @return Linker
     */
    public function setPlatform(\Yap\SpeedrunBundle\Entity\Platform $platform = null)
    {
        $this->platform = $platform;

        return $this;
    }

    /**
     * Get platform
     *
     * @return \Yap\SpeedrunBundle\Entity\Platform 
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * Set difficulty
     *
     * @param \Yap\SpeedrunBundle\Entity\Difficulty $difficulty
     * @return Linker
     */
    public function setDifficulty(\Yap\SpeedrunBundle\Entity\Difficulty $difficulty = null)
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    /**
     * Get difficulty
     *
     * @return \Yap\SpeedrunBundle\Entity\Difficulty 
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Linker
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set scripted
     *
     * @param boolean $scripted
     * @return Linker
     */
    public function setScripted($scripted)
    {
        $this->scripted = $scripted;

        return $this;
    }

    /**
     * Get scripted
     *
     * @return boolean 
     */
    public function getScripted()
    {
        return $this->scripted;
    }

    /**
     * Set segmented
     *
     * @param boolean $segmented
     * @return Linker
     */
    public function setSegmented($segmented)
    {
        $this->segmented = $segmented;

        return $this;
    }

    /**
     * Get segmented
     *
     * @return boolean 
     */
    public function getSegmented()
    {
        return $this->segmented;
    }

    /**
     * Set tas
     *
     * @param boolean $tas
     * @return Linker
     */
    public function setTas($tas)
    {
        $this->tas = $tas;

        return $this;
    }

    /**
     * Get tas
     *
     * @return boolean 
     */
    public function getTas()
    {
        return $this->tas;
    }

    /**
     * Set version
     *
     * @param string $version
     * @return Linker
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string 
     */
    public function getVersion()
    {
        return $this->version;
    }
}
