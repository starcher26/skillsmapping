<?php
/**
 * Created by PhpStorm.
 * User: Mounir
 * Date: 18/03/2017
 * Time: 22:03
 */

namespace Nalys\SkillsmappingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Nalys\SkillsmappingBundle\Repository\UserSkillRepository")
 * @ORM\Table(name="nalys_user_skill")
 */
class UserSkill
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
     * @ORM\ManyToOne(targetEntity="Nalys\SkillsmappingBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Nalys\SkillsmappingBundle\Entity\Skill")
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
     * @return UserSkill
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
     * Set user
     *
     * @param \Nalys\SkillsmappingBundle\Entity\User $user
     *
     * @return UserSkill
     */
    public function setUser(\Nalys\SkillsmappingBundle\Entity\User $user)
    {
        $this->user = $user;

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
     * Set skill
     *
     * @param \Nalys\SkillsmappingBundle\Entity\Skill $skill
     *
     * @return UserSkill
     */
    public function setSkill(\Nalys\SkillsmappingBundle\Entity\Skill $skill)
    {
        $this->skill = $skill;

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
