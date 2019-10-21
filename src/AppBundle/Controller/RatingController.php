<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Rating;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Commande controller.
 *
 * @Route("rating")
 */
class RatingController extends Controller
{

    /**
     * Creates a new ligne entity.
     *
     * @Route("/new", name="newRating")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $rating = new Rating();
        $form = $this->createForm('AppBundle\Form\RatingType', $rating);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rating);
            $em->flush();

            return $this->redirectToRoute('allarticles',array(
                'user'=>$this->getUser()
            ));
        }

        return $this->render('@App/commande/success.html.twig', array(
            'rating' => $rating,
            'form' => $form->createView(),
            'user'=>$this->getUser()
        ));
    }

}
