<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Avis;
use AppBundle\Entity\User;
use FOS\UserBundle\Controller\SecurityController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    public function userProfileAction()
    {

     /*   $user = new User();
        $user->getBirthday()
       */
        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
        {

            $user = $this->get('security.token_storage')->getToken()->getUser();

            return $this->render('@App/Profile/profileUser.html.twig', array('user'=>$user ));
        }

        else
            $sec = new SecurityController();
            return $sec->loginAction();
    }



}
