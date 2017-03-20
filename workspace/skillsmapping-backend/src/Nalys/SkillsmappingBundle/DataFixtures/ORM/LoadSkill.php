<?php
/**
 * Created by PhpStorm.
 * User: Mounir
 * Date: 20/03/2017
 * Time: 09:30
 */

namespace Nalys\SkillsmappingBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nalys\SkillsmappingBundle\Entity\Skill;

class LoadSkill implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $names = array('PHP', 'Symfony', 'C++', 'Java', 'Photoshop', 'Blender', 'Bloc-note');

        foreach ($names as $name) {
            $skill = new Skill();
            $skill->setName($name);

            $manager->persist($skill);
        }

        // On déclenche l'enregistrement de toutes les compétences
        $manager->flush();
    }
}
