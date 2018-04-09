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
     * Creates a new panier entity.
     *
     * @Route("/new", name="panier_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $panier = new Panier();
        $form = $this->createForm('AppBundle\Form\PanierType', $panier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($panier);
            $em->flush();

            return $this->redirectToRoute('panier_show', array('id' => $panier->getId()));
        }

        return $this->render('@App/panier/new.html.twig', array(
            'panier' => $panier,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a panier entity.
     *
     * @Route("/{id}", name="panier_show")
     * @Method("GET")
     */
    public function showAction(Panier $panier)
    {
        $deleteForm = $this->createDeleteForm($panier);

        return $this->render('@App/panier/show.html.twig', array(
            'panier' => $panier,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing panier entity.
     *
     * @Route("/{id}/edit", name="panier_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Panier $panier)
    {
        $deleteForm = $this->createDeleteForm($panier);
        $editForm = $this->createForm('AppBundle\Form\PanierType', $panier);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('panier_edit', array('id' => $panier->getId()));
        }

        return $this->render('@App/panier/edit.html.twig', array(
            'panier' => $panier,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a panier entity.
     *
     * @Route("/{id}", name="panier_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Panier $panier)
    {
        $form = $this->createDeleteForm($panier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($panier);
            $em->flush();
        }

        return $this->redirectToRoute('panier_index');
    }

    /**
     * Creates a form to delete a panier entity.
     *
     * @param Panier $panier The panier entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Panier $panier)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('panier_delete', array('id' => $panier->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * Creates a form to delete a panier entity.
     *
     * @Route("/addToPanier", name="addToPanier")
     * @Method("POST")
     */
    public function addToPanier(Request $request)
    {


        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('AppBundle:Article')->find($request->request->get('article_id'));
        $panier = $user->getPanier();
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


}
