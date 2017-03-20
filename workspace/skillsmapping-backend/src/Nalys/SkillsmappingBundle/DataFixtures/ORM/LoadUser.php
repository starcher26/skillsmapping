<?php
/**
 * Created by PhpStorm.
 * User: Mounir
 * Date: 18/03/2017
 * Time: 22:31
 */

namespace Nalys\SkillsmappingBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nalys\SkillsmappingBundle\Entity\Role;
use Nalys\SkillsmappingBundle\Entity\User;
use Nalys\SkillsmappingBundle\Entity\UserSkill;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
//use AppBundle\Entity\Group;
class LoadUser extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {
    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


    public function getOrder() {
        return 0;
    }

    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $admin = $manager->getRepository("NalysSkillsmappingBundle:Group")->findOneBy(array('name'=>'Admin'));
        $consultant = $manager->getRepository("NalysSkillsmappingBundle:Group")->findOneBy(array('name'=>'Consultant'));
        $user = $userManager->createUser();
        $user
            ->setUsername('test')
            ->addGroup($consultant)
            ->setEmail('test@test.com')
            ->setFirstLogin(\DateTime::createFromFormat('Y-m-d', '2017-02-09'))
            ->setHiredDate(\DateTime::createFromFormat('Y-m-d', '2017-01-09'))
            ->setEnabled(true)
            ->setLastName("TEST")
            ->setFirstName("Test");
        $user->setPlainPassword('test123');
        $listSkills = $manager->getRepository('NalysSkillsmappingBundle:Skill')->findAll();
        foreach ($listSkills as $skill) {
            $userSkill = new UserSkill();
            $userSkill->setUser($user);
            $userSkill->setSkill($skill);

            $userSkill->setLevel(10);

            $manager->persist($userSkill);
        }
        $userManager->updateUser($user);

        $user = $userManager->createUser();
        $user
            ->setUsername('mkhebbaza')
            ->addGroup($admin)
            ->setEmail('mkhebbaza@nalys-group.com')
            ->setFirstLogin(\DateTime::createFromFormat('Y-m-d', '2017-02-09'))
            ->setHiredDate(\DateTime::createFromFormat('Y-m-d', '2017-01-09'))
            ->setEnabled(true)
            ->setLastName("KHEBBAZA")
            ->setFirstName("Mounir");
        $user->setPlainPassword('pass123');
        $listSkills = $manager->getRepository('NalysSkillsmappingBundle:Skill')->findAll();
        foreach ($listSkills as $skill) {
            $userSkill = new UserSkill();
            $userSkill->setUser($user);
            $userSkill->setSkill($skill);

            $userSkill->setLevel(5);

            $manager->persist($userSkill);
        }
        $userManager->updateUser($user);
        //$manager->persist($user);
        //$manager->flush();
    }

}
