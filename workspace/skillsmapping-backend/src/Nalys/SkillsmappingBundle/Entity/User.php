<?php
/**
 * Created by PhpStorm.
 * User: Mounir
 * Date: 18/03/2017
 * Time: 21:32
 */

namespace Nalys\SkillsmappingBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="nalys_user")
 * @ORM\Entity(repositoryClass="Nalys\SkillsmappingBundle\Repository\UserRepository")
 *
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     */
    private $firstName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hiredDate", type="datetime", nullable=true)
     */
    private $hiredDate;

    /**
     * @ORM\Column(type="integer", length=6, options={"default":0})
     */
    protected $loginCount = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $firstLogin;

    /**
     * @ORM\ManyToMany(targetEntity="Nalys\SkillsmappingBundle\Entity\Group")
     * @ORM\JoinTable(name="nalys_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;

    /**
     * @ORM\OneToOne(targetEntity="Nalys\SkillsmappingBundle\Entity\Image", cascade={"persist"})
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="Nalys\SkillsmappingBundle\Entity\Division", cascade={"persist"})
     * @ORM\JoinTable(name="nalys_user_division")
     *
     */
    private $divisions;

    // Constructor
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set hiredDate
     *
     * @param \DateTime $hiredDate
     *
     * @return User
     */
    public function setHiredDate($hiredDate)
    {
        $this->hiredDate = $hiredDate;

        return $this;
    }

    /**
     * Get hiredDate
     *
     * @return \DateTime
     */
    public function getHiredDate()
    {
        return $this->hiredDate;
    }

    /**
     * Set loginCount
     *
     * @param integer $loginCount
     *
     * @return User
     */
    public function setLoginCount($loginCount)
    {
        $this->loginCount = $loginCount;

        return $this;
    }

    /**
     * Get loginCount
     *
     * @return integer
     */
    public function getLoginCount()
    {
        return $this->loginCount;
    }

    /**
     * Set firstLogin
     *
     * @param \DateTime $firstLogin
     *
     * @return User
     */
    public function setFirstLogin($firstLogin)
    {
        $this->firstLogin = $firstLogin;

        return $this;
    }

    /**
     * Get firstLogin
     *
     * @return \DateTime
     */
    public function getFirstLogin()
    {
        return $this->firstLogin;
    }

    /**
     * Set image
     *
     * @param \Nalys\SkillsmappingBundle\Entity\Image $image
     *
     * @return User
     */
    public function setImage(\Nalys\SkillsmappingBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Nalys\SkillsmappingBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add division
     *
     * @param \Nalys\SkillsmappingBundle\Entity\Division $division
     *
     * @return User
     */
    public function addDivision(\Nalys\SkillsmappingBundle\Entity\Division $division)
    {
        $this->divisions[] = $division;

        return $this;
    }

    /**
     * Remove division
     *
     * @param \Nalys\SkillsmappingBundle\Entity\Division $division
     */
    public function removeDivision(\Nalys\SkillsmappingBundle\Entity\Division $division)
    {
        $this->divisions->removeElement($division);
    }

    /**
     * Get divisions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDivisions()
    {
        return $this->divisions;
    }
}
