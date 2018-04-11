<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * Commande controller.
 *
 * @Route("admin")
 */
class AdminController extends Controller
{

    /**
     *
     * @Route("/ratings", name="ratings")
     * @Method("GET")
     */
    public function viewRating(){
        $em=$this->getDoctrine()->getManager();
        $ratings = $em->getRepository('AppBundle:Rating')->findAll();
        $moyenne=0;
        foreach ($ratings as $rating){
            $moyenne+= $rating->getRating();
        }
        $moyenne=$moyenne/count($ratings);
        return  $this->render('@App/admin/rating.html.twig',array(
            'ratings'=>$ratings,
            'moyenne'=>$moyenne
        ));
    }

    /**
     *
     * @Route("/commandes", name="commandes")
     * @Method("GET")
     */
    public function viewCommandes(){
        $em=$this->getDoctrine()->getManager();
        $commandes = $em->getRepository('AppBundle:Commande')->findAll();
        $nbrpayee =count($em->getRepository('AppBundle:Commande')->findBy(['etat'=>1]));
        $nbrNonPayee = count($commandes)-$nbrpayee;
        return  $this->render('@App/admin/commande.html.twig',array(
            'commandes'=>$commandes,
            'nbrPayee'=>$nbrpayee,
            'nbrNonPayee'=>$nbrNonPayee
        ));
    }
}
