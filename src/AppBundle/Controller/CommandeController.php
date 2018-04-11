<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Acheteur;
use AppBundle\Entity\Commande;
use AppBundle\Entity\Rating;
use GuzzleHttp\Psr7\Response;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


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
        $diffInSeconds = (new \DateTime())->getTimestamp() - $commande->getDate()->getTimestamp();
        return $this->render('@App/commande/show.html.twig', array(
            'commande' => $commande,
            'user' => $this->getUser(),
            'totale'=>$totale,
            'interval'=>$diffInSeconds
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
            $ligne->getArticle()->setQuantity($ligne->getArticle()->getQuantity() - $ligne->getQuantite());
            $em->persist($ligne->getArticle());
            $em->flush();
        }
        \Stripe\Stripe::setApiKey("sk_test_2NJiT6SqEHyBuR9D5oKFAjHR");
        $token = $request->request->get('stripeToken');
        $charge = \Stripe\Charge::create([
            'amount' => $totale*118,
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

        return $this->redirectToRoute('newRating');
    }

    /**
     *
     * @Route("/{id}/pdfCommande", name="pdfCommande")
     * @Method("GET")
     */
    public function pdfCommandeAction(Request $request,$id)
    {   $em=$this->getDoctrine()->getManager();
        $user=$this->getUser();

        $commande=$em->getRepository('AppBundle:Commande')->find($id);
        $totale=0;
        foreach ($commande->getPanier()->getUserRecipeAssociations() as $ligne){
            $totale+=  ($ligne->getArticle()->getPrix() * $ligne->getQuantite());
        }
        $html= $this->renderView('@App/commande/template.html.twig',array(
            'user'=> $user,
            'commande'=>$commande,
            'totale'=>$totale,
            'local'=> $this->get('kernel')->getRootDir() . '/../web/'
        ));



        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            'commande.pdf'
        );
    }



    /**
     *
     * @Route("/{id}/removeCommande", name="removeCommande")
     * @Method("Get")
     */
    public function removeCommandeAction(Request $request,$id)
    {   $em=$this->getDoctrine()->getManager();
        $commande=$em->getRepository('AppBundle:Commande')->find($id);
        foreach ($commande->getPanier()->getUserRecipeAssociations() as $ligne){
            $em->remove($ligne);
        }
        $this->getUser()->setPanier(null);
        $em->flush();
        $em->remove($commande->getPanier());
        $em->flush();
        $em->remove($commande);
        $em->flush();

        return $this->redirectToRoute('allarticles',array(
            'user'=>$this->getUser()
        ));
    }

    /**
     *
     * @Route("/{id}/validateCommande", name="validateCommande")
     * @Method("Get")
     */
    public function validateCommandeAction(Request $request,$id)
    {   $em=$this->getDoctrine()->getManager();
        $commande=$em->getRepository('AppBundle:Commande')->find($id);
        foreach ($commande->getPanier()->getUserRecipeAssociations() as $ligne){
            $ligne->getArticle()->setQuantity($ligne->getArticle()->getQuantity() - $ligne->getQuantite());
            $em->persist($ligne->getArticle());
            $em->flush();
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
