<?php
/**
 * Created by PhpStorm.
 * User: Mounir
 * Date: 18/03/2017
 * Time: 22:55
 */

namespace Nalys\SkillsmappingBundle\DataFixtures\ORM;
use Doctrine\Common\Persistence\ObjectManager;
use Nalys\SkillsmappingBundle\Entity\Group;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadGroup extends AbstractFixture implements ContainerAwareInterface
{
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

    public function load(ObjectManager $manager)
    {
        $groupManager = $this->container->get('fos_user.group_manager');


        $groups = array("Consultant", "Manager", "CEO", "Admin");
        $roles = array(
            "Consultant"=> array("ROLE_CONSULTANT"),
            "Manager" => array("ROLE_MANAGER"),
            "CEO" => array("ROLE_CEO"),
            "Admin" => array("ROLE_ADMIN")
        );
        foreach ($groups as $group_name)
        {
            $group = $groupManager->createGroup($group_name);
            $group->setName($group_name);
            $group->setRoles($roles[$group_name]);
            $groupManager->updateGroup($group);
        }
    }
}