<?php
/**
 * Created by PhpStorm.
 * User: Mounir
 * Date: 20/03/2017
 * Time: 10:42
 */

namespace Nalys\SkillsmappingBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nalys\SkillsmappingBundle\Entity\Division;

class LoadDivision
{
    public function load(ObjectManager $manager)
    {
        $names = array('Webapp', 'Mechanic', 'Life Science', 'Embedded');

        foreach ($names as $name) {
            $division = new Division();
            $division->setName($name);
            $division->setDivision("Webapp");

            $manager->persist($division);
        }

        // On déclenche l'enregistrement de toutes les compétences
        $manager->flush();
    }
}