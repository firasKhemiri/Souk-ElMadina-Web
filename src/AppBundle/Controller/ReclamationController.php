<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Reclamation;
use AppBundle\Form\ReclamationType;

class ReclamationController extends Controller
{
    public function ajoutAction(Request $request)
    {


        $reclamation = new reclamation();
        $Form = $this->createForm(ReclamationType::class,$reclamation);
        $Form->handleRequest($request);
        if($Form->isSubmitted()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();
            return $this->redirect($this->generateUrl('ajoutreclamation'));
        }
        return $this->render('AppBundle:reclamation:reclamation.html.twig',array('ReclamationForm'=>$Form->createView()));

    }
}
