<?php

namespace Yap\SpeedrunBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * Game
 *
 * @ORM\Table(name="spr_game")
 * @ORM\Entity(repositoryClass="Yap\SpeedrunBundle\Entity\GameRepository")
 * @Vich\Uploadable
 * @ExclusionPolicy("all") 
 */
class Game
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
    * @Gedmo\Slug(fields={"name"})
    * @ORM\Column(length=128, unique=true)
    * @Expose
    */
    private $slug;

    /**
    * @ORM\Column(name="visible", type="boolean")
    * @Expose
    */
    private $visible;

    /**
    * @ORM\Column(name="official", type="boolean")
    * @Expose
    */
    private $official;

    /**
    * @ORM\OneToMany(targetEntity="Yap\SpeedrunBundle\Entity\Level", mappedBy="game", cascade={"persist"})
    * @Expose
    */
    private $levels;

    /**
    * @ORM\OneToMany(targetEntity="Yap\SpeedrunBundle\Entity\Difficulty", mappedBy="game", cascade={"persist"})
    */
    private $difficulties;

    /**
    * @ORM\OneToMany(targetEntity="Yap\SpeedrunBundle\Entity\Linker", mappedBy="game", cascade={"persist"})
    * @Expose
    */
    private $linkers;

    /**
     * @Vich\UploadableField(mapping="game_image", fileNameProperty="imageName")
     *
     * @var File $imageFile
     */
    protected $imageFile;

    /**
     * @ORM\Column(type="string", length=255, name="image_name")
     *
     * @var string $imageName
     */
    protected $imageName;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime $updatedAt
     * @Expose
     */
    protected $updatedAt;

    /**
    * @ORM\ManyToMany(targetEntity="Yap\UserBundle\Entity\User", cascade={"persist"})
    * @ORM\JoinTable(name="spr_moderators_game")
    */
    private $users;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->visible = false;
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->levels = new \Doctrine\Common\Collections\ArrayCollection();
        $this->difficulties = new \Doctrine\Common\Collections\ArrayCollection();
        $this->linkers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->linkers = null;
    }

    public function __toString()
    {
        return $this->name;
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
     * Set name
     *
     * @param string $name
     * @return Game
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
     * Set visible
     *
     * @param boolean $visible
     * @return Game
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean 
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set official
     *
     * @param boolean $official
     * @return Game
     */
    public function setOfficial($official)
    {
        $this->official = $official;

        return $this;
    }

    /**
     * Get official
     *
     * @return boolean 
     */
    public function getOfficial()
    {
        return $this->official;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Game
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add levels
     *
     * @param \Yap\SpeedrunBundle\Entity\Level $levels
     * @return Game
     */
    public function addLevel(\Yap\SpeedrunBundle\Entity\Level $levels)
    {
        $this->levels[] = $levels;
        $levels->setGame($this);

        return $this;
    }

    /**
     * Remove levels
     *
     * @param \Yap\SpeedrunBundle\Entity\Level $levels
     */
    public function removeLevel(\Yap\SpeedrunBundle\Entity\Level $levels)
    {
        $this->levels->removeElement($levels);
    }

    /**
     * Get levels
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLevels()
    {
        return $this->levels;
    }

    /**
     * Add difficulties
     *
     * @param \Yap\SpeedrunBundle\Entity\Difficulty $difficulties
     * @return Game
     */
    public function addDifficulty(\Yap\SpeedrunBundle\Entity\Difficulty $difficulties)
    {
        $this->difficulties[] = $difficulties;
        $difficulties->setGame($this);

        return $this;
    }

    /**
     * Remove difficulties
     *
     * @param \Yap\SpeedrunBundle\Entity\Difficulty $difficulties
     */
    public function removeDifficulty(\Yap\SpeedrunBundle\Entity\Difficulty $difficulties)
    {
        $this->difficulties->removeElement($difficulties);
    }

    /**
     * Get difficulties
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDifficulties()
    {
        return $this->difficulties;
    }

    /**
     * Add linkers
     *
     * @param \Yap\SpeedrunBundle\Entity\Linker $linkers
     * @return Game
     */
    public function addLinker(\Yap\SpeedrunBundle\Entity\Linker $linkers)
    {
        $this->linkers[] = $linkers;

        return $this;
    }

    /**
     * Remove linkers
     *
     * @param \Yap\SpeedrunBundle\Entity\Linker $linkers
     */
    public function removeLinker(\Yap\SpeedrunBundle\Entity\Linker $linkers)
    {
        $this->linkers->removeElement($linkers);
    }

    /**
     * Get linkers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLinkers()
    {
        return $this->linkers;
    }

        /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Game
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add users
     *
     * @param \Yap\UserBundle\Entity\User $users
     * @return Game
     */
    public function addUser(\Yap\UserBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Yap\UserBundle\Entity\User $users
     */
    public function removeUser(\Yap\UserBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}
