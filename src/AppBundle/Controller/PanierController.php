<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ligne;
use AppBundle\Entity\Panier;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

/**
 * Panier controller.
 *
 * @Route("panier")
 */
class PanierController extends Controller
{
    /**
     * Lists all panier entities.
     *
     * @Route("/", name="panier_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();


        return $this->render('@App/panier/index.html.twig', array(
            'user' => $user,
            'articles' => $em->getRepository('AppBundle:Article')->getArticleFromPanier($user->getPanier())
        ));
    }

    /**
     * Creates a form to delete a panier entity.
     *
     * @Route("/addToPanier", name="addToPanier")
     * @Method("POST")
     */
    public function addToPanierAction(Request $request)
    {


        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('AppBundle:Article')->find($request->request->get('article_id'));
        $panier = $user->getPanier();
        if($article->getQuantity()){
        if ($panier) {
            $ligne = $em->getRepository('AppBundle:Ligne')->findOneBy(['article' => $article, 'panier' => $panier]);
            if (!$ligne) {
                $ligne = new Ligne();
                $ligne->setPanier($panier);
                $ligne->setArticle($article);
            }

            $ligne->setQuantite($ligne->getQuantite() + 1);
            $panier->addUserRecipeAssociation($ligne);
            $em->persist($panier);
            $em->flush();
            $em->persist($ligne);
            $em->flush();


        } else {
            $panier = new Panier();
            $user->setPanier($panier);
            $ligne = new Ligne();

            $ligne->setPanier($panier);
            $ligne->setArticle($article);
            $ligne->setQuantite(1);
            $panier->addUserRecipeAssociation($ligne);
            $em->persist($panier);
            $em->flush();
            $em->persist($user);
            $em->flush();
            $em->persist($ligne);
            $em->flush();

        }
        $s = $em->getRepository('AppBundle:Article')->getArticleFromPanier($panier);

        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);
        // Add Circular reference handler
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $encoders = array(new JsonEncoder());
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);

        return new Response($serializer->serialize($s, 'json'));
        }
        else{
          return new JsonResponse('failed');
        }

    }


    /**
     * @param Request $request
     * @return Response
     * @Route("/panierItems",name="panierItems")
     * @Method("GET")
     */
    public function getPanierItemAction(Request $request){
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $panier=$user->getPanier();
        $s = $em->getRepository('AppBundle:Article')->getArticleFromPanier($panier);
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);
        // Add Circular reference handler
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $encoders = array(new JsonEncoder());
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);

        return new Response($serializer->serialize($s, 'json'));
    }


    /**
     * @Route("/deleteItem",name="deleteItem")
     * @Method("Post")
     */
    public function deleteItem(Request $request){

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
       $panier=$user->getPanier();
        $ligne=$em->getRepository('AppBundle:Ligne')->findOneBy(
            [
                'panier'=>$panier,
                'article'=>$em->getRepository('AppBundle:Article')->find($request->request->get('id'))]);
        $em->remove($ligne);
        $em->flush();
        return new JsonResponse('success');
    }


    /**
     * @Route("/updateItem",name="updateItem")
     * @Method("Post")
     */
    public function updateItem(Request $request){

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $panier=$user->getPanier();
        $ligne=$em->getRepository('AppBundle:Ligne')->findOneBy(
            [
                'panier'=>$panier,
                'article'=>$em->getRepository('AppBundle:Article')->find($request->request->get('id'))]);
        $ligne->setQuantite($request->request->get('quantite'));
        $em->persist($ligne);
        $em->flush();
        return new JsonResponse('success');
    }
}
