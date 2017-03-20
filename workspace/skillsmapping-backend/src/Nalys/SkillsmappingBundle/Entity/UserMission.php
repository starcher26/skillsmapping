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
 * @ORM\Entity(repositoryClass="Nalys\SkillsmappingBundle\Repository\UserMissionRepository")
 * @ORM\Table(name="nalys_user_mission")
 */
class UserMission
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="current", type="boolean")
     */
    private $current;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startDate", type="datetime")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="datetime", nullable=true)
     */
    private $endDate;

    /**
     * @ORM\ManyToOne(targetEntity="Nalys\SkillsmappingBundle\Entity\User", inversedBy="userMissions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Nalys\SkillsmappingBundle\Entity\Mission", inversedBy="missionUsers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mission;


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
     * Set duration
     *
     * @param string $duration
     *
     * @return UserMission
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
     * Set user
     *
     * @param \Nalys\SkillsmappingBundle\Entity\User $user
     *
     * @return UserMission
     */
    public function setUser(\Nalys\SkillsmappingBundle\Entity\User $user)
    {
        $this->user = $user;
        $user->addUserMission($this);
        return $this;
    }

    /**
     * Get user
     *
     * @return \Nalys\SkillsmappingBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set mission
     *
     * @param \Nalys\SkillsmappingBundle\Entity\Mission $mission
     *
     * @return UserMission
     */
    public function setMission(\Nalys\SkillsmappingBundle\Entity\Mission $mission)
    {
        $this->mission = $mission;
        $mission->addMissionUser($this);
        return $this;
    }

    /**
     * Get mission
     *
     * @return \Nalys\SkillsmappingBundle\Entity\Mission
     */
    public function getMission()
    {
        return $this->mission;
    }

    /**
     * Set current
     *
     * @param boolean $current
     *
     * @return UserMission
     */
    public function setCurrent($current)
    {
        $this->current = $current;

        return $this;
    }

    /**
     * Get current
     *
     * @return boolean
     */
    public function getCurrent()
    {
        return $this->current;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return UserMission
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return UserMission
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }
}
