<?php
/**
 * Created by PhpStorm.
 * User: Mounir
 * Date: 18/03/2017
 * Time: 22:56
 */

namespace Nalys\SkillsmappingBundle\Controller;
use Nalys\SkillsmappingBundle\Entity\Group;
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


class GroupController extends FOSRestController implements ClassResourceInterface
{
    /**
     * Gets all groups
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     * @ApiDoc(
     *     output="Nalys\SkillsmappingBundle\Entity\Group",
     *     statusCodes={
     *         200 = "Returned when successful",
     *         404 = "Return when not found"
     *     }
     * )
     */
    public function cgetAction()
    {
        $groups = $this->getDoctrine()
            ->getManager()
            ->getRepository('NalysSkillsmappingBundle:Group')
            ->findAll();
        if (null === $groups) {
            throw new NotFoundHttpException("No Groups found.");
        }
        return $groups;
    }
}