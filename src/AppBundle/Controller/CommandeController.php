<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Acheteur;
use AppBundle\Entity\Commande;
use GuzzleHttp\Psr7\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Commande controller.
 *
 * @Route("commande")
 */
class CommandeController extends Controller
{
    /**
     * @Route("/new", name="newCommande")
     * @Method("POST")
     */
    public function createCommande(Request $request){
        $em= $this->getDoctrine()->getManager();
        $user= $this->getUser();
        $panier= $user->getPanier();
        $commande=$em->getRepository('AppBundle:Commande')->findOneBy(['acheteur'=>$user]);
        if(!$commande){
        $commande=new Commande();
        }
        $commande->setPanier($panier);
        $commande->setAcheteur($user);
        $commande->setMethLivraison($request->request->get('livraison'));
        $commande->setMethPaiment($request->request->get('paiment'));
        $commande->setAdressLiv($request->request->get('adresse'));
        $commande->setEtat(0);
        $commande->setDate(new \DateTime());

        $em->persist($commande);
        $em->flush();
        return $this->redirectToRoute('showCommande',['id'=>$commande->getId()]);
    }


    /**
     * Finds and displays a ligne entity.
     *
     * @Route("/{id}", name="showCommande")
     * @Method("GET")
     */
    public function showAction(Request $request,$id)
    {

        $em=$this->getDoctrine()->getManager();
        $commande=$em->getRepository('AppBundle:Commande')->find($id);
        $totale=0;
        foreach ($commande->getPanier()->getUserRecipeAssociations() as $ligne){
          $totale+=  ($ligne->getArticle()->getPrix() * $ligne->getQuantite());
        }
        return $this->render('@App/commande/show.html.twig', array(
            'commande' => $commande,
            'user' => $this->getUser(),
            'totale'=>$totale
        ));
    }

    /**
     * Finds and displays a ligne entity.
     *
     * @Route("/{id}/payer", name="payerCommande")
     * @Method("POST")
     */
    public function payAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $commande=$em->getRepository('AppBundle:Commande')->find($id);
        $totale=0;
        foreach ($commande->getPanier()->getUserRecipeAssociations() as $ligne){
            $totale+=  ($ligne->getArticle()->getPrix() * $ligne->getQuantite());
        }
        \Stripe\Stripe::setApiKey("sk_test_2NJiT6SqEHyBuR9D5oKFAjHR");
        $token = $request->request->get('stripeToken');
        $charge = \Stripe\Charge::create([
            'amount' => $totale*100,
            'currency' => 'eur',
            'description' => 'Payment',
            'source' => $token,
        ]);
        foreach ($commande->getPanier()->getUserRecipeAssociations() as $ligne){
            $em->remove($ligne);
        }
        $this->getUser()->setPanier(null);
        $em->flush();
        $em->remove($commande->getPanier());
        $em->flush();
        $em->remove($commande);
        $em->flush();

        return new JsonResponse('success');
    }
}
