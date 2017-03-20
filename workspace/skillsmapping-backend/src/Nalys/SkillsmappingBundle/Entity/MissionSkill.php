<?php
/**
 * Created by PhpStorm.
 * User: Mounir
 * Date: 18/03/2017
 * Time: 22:17
 */
namespace Nalys\SkillsmappingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Nalys\SkillsmappingBundle\Repository\MissionSkillRepository")
 * @ORM\Table(name="nalys_mission_skill")
 */
class MissionSkill
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="level", type="integer", length=2)
     */
    private $level;

    /**
     * @ORM\ManyToOne(targetEntity="Nalys\SkillsmappingBundle\Entity\Mission", inversedBy="missionSkills")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mission;

    /**
     * @ORM\ManyToOne(targetEntity="Nalys\SkillsmappingBundle\Entity\Skill", inversedBy="skillMissions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $skill;



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
     * Set level
     *
     * @param int $level
     *
     * @return MissionSkill
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set Mission
     *
     * @param \Nalys\SkillsmappingBundle\Entity\Mission $mission
     *
     * @return MissionSkill
     */
    public function setMission(\Nalys\SkillsmappingBundle\Entity\Mission $mission)
    {
        $this->mission = $mission;
        $mission->addMissionSkill($this);
        return $this;
    }

    /**
     * Get Mission
     *
     * @return \Nalys\SkillsmappingBundle\Entity\Mission
     */
    public function getMission()
    {
        return $this->mission;
    }

    /**
     * Set skill
     *
     * @param \Nalys\SkillsmappingBundle\Entity\Skill $skill
     *
     * @return MissionSkill
     */
    public function setSkill(\Nalys\SkillsmappingBundle\Entity\Skill $skill)
    {
        $this->skill = $skill;
        $skill->addSkillMission($this);
        return $this;
    }

    /**
     * Get skill
     *
     * @return \Nalys\SkillsmappingBundle\Entity\Skill
     */
    public function getSkill()
    {
        return $this->skill;
    }
}
