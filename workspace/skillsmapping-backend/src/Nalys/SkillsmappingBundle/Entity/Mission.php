<?php
/**
 * Created by PhpStorm.
 * User: Mounir
 * Date: 18/03/2017
 * Time: 22:09
 */
namespace Nalys\SkillsmappingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mission
 *
 * @ORM\Table(name="nalys_mission")
 * @ORM\Entity(repositoryClass="Nalys\SkillsmappingBundle\Repository\MissionRepository")
 */
class Mission
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Nalys\SkillsmappingBundle\Entity\Customer", inversedBy="missions")
     */
    private $customer;

    /**
     * @ORM\Column(name="duration", type="string", length=255)
     */
    private $duration;



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
     *
     * @return Mission
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
     * Set duration
     *
     * @param string $duration
     *
     * @return Mission
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set customer
     *
     * @param \Nalys\SkillsmappingBundle\Entity\Customer $customer
     *
     * @return Mission
     */
    public function setCustomer(\Nalys\SkillsmappingBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \Nalys\SkillsmappingBundle\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }
}
