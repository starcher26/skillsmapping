<?php
/**
 * Created by PhpStorm.
 * User: Mounir
 * Date: 19/03/2017
 * Time: 09:20
 */

namespace Nalys\SkillsmappingBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nalys\SkillsmappingBundle\Entity\Customer;
use Nalys\SkillsmappingBundle\Entity\Location;
use Nalys\SkillsmappingBundle\Entity\Mission;

class LoadMission implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Liste des noms de compétences à ajouter
        $names = array('PHP developper', 'Java developper', 'Scrum Master',
            'DevOps', 'Stress Engineer', 'Automation Engineer');
        $location = new Location();
        $location->setAddress("Rue de la République, 124");
        $location->setCity("Brussels");
        $location->setCountry("Belgium");
        $manager->persist($location);
        $customer = new Customer();
        $customer->setName("PFB");
        $customer->addLocation($location);
        $manager->persist($customer);

        foreach ($names as $name) {

            $mission = new Mission();
            $mission->setName($name);

            $mission->setDuration("6 months");
            $mission->setCustomer($customer);

            // On la persiste
            $manager->persist($mission);
        }

        // On déclenche l'enregistrement de toutes les compétences
        $manager->flush();
    }
}
