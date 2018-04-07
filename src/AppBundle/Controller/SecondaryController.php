<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Avis;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SecondaryController extends Controller
{


    public function contactAction()
    {
        $user = new User();

        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->get('security.token_storage')->getToken()->getUser();

        }

        return $this->render('@App/articles/contact.html.twig', array('user'=>$user ));
    }


    public function blogAction()
    {
        $user = new User();

        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->get('security.token_storage')->getToken()->getUser();

        }

        return $this->render('@App/articles/blog.html.twig', array('user'=>$user ));
    }







}
