<?php
/**
 * Created by PhpStorm.
 * User: Mounir
 * Date: 18/03/2017
 * Time: 22:51
 */

namespace Nalys\SkillsmappingBundle\Controller;



use Nalys\SkillsmappingBundle\Entity\User;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\RouteRedirectView;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Class UsersController
 * @package Nalys\SkillsmappingBundle\Controller
 *
 */
class UserController extends FOSRestController implements ClassResourceInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;
    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Gets an individual user
     *
     * @param int $id
     * @return mixed
     *
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     * @ApiDoc(
     *     output="Nalys\SkillsmappingBundle\Entity\User",
     *     statusCodes={
     *         200 = "Returned when successful",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function getAction($id)
    {
        $user = $this->getDoctrine()
            ->getManager()
            ->getRepository('NalysSkillsmappingBundle:User')
            ->find($id)
        ;
        if (null === $user) {
            throw new NotFoundHttpException("User id ".$id." does not exist.");
        }
        return $user;
    }
    /**
     * Gets all users
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     * @ApiDoc(
     *     output="Nalys\SkillsmappingBundle\Entity\User",
     *     statusCodes={
     *         200 = "Returned when successful",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function cgetAction()
    {
        $users = $this->getDoctrine()
            ->getManager()
            ->getRepository('NalysSkillsmappingBundle:User')
            ->findAll();
        if (null === $users) {
            throw new NotFoundHttpException("No registration to the web site.");
        }
        return $users;
    }

    /**
     * Creates a user
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     * @ApiDoc(
     *     output="Nalys\SkillsmappingBundle\Entity\User",
     *     statusCodes={
     *         200 = "Returned when successful",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function postAction(Request $request)
    {

        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $user
            ->setUsername(strtolower($request->get('username')))
            ->setEmail(strtolower($request->get('email')))
            ->setHiredDate($request->get('hiredDate'))
            ->setEnabled(true)
            ->setLastName($request->get('lastName'))
            ->setFirstName($request->get('firstName'));
        $user->setPlainPassword($request->get('password'));

        foreach($request->get('groups') as $group_name) // $group_name => string
        {
            $group = $this->getDoctrine()
                ->getManager()
                ->getRepository("NalysSkillsmappingBundle:Group")->findOneBy(
                    array('name'=>$group_name)
                );
            $user->addGroup($group);
            foreach ($group->getRoles() as $role)
                $user->addRole($role);
        }
        $userManager->updateUser($user);
        return $user;

    }
    /**
     * Deactivates a user instead of definetely removing it
     *
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/users/{id}")
     *
     * @ApiDoc(
     *     output="Nalys\SkillsmappingBundle\Entity\User",
     *     statusCodes={
     *         204 = "Returned when successful",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function removeUserAction($id)
    {
        $user = $this->getDoctrine()
            ->getManager()
            ->getRepository('NalysSkillsmappingBundle:User')
            ->find($id);
        $user->setEnabled(false);
        $userManager = $this->container->get('fos_user.user_manager');
        $userManager->updateUser($user);

    }
}