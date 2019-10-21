<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Enchere;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Enchere controller.
 *
 */
class EnchereController extends Controller
{
    /**
     * Lists all enchere entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $encheres = $em->getRepository('AppBundle:Enchere')->findAll();

        return $this->render('enchere/index.html.twig', array(
            'encheres' => $encheres,
        ));
    }

    /**
     * Creates a new enchere entity.
     *
     */
    public function newAction(Request $request)
    {
        $enchere = new Enchere();
        $form = $this->createForm('AppBundle\Form\EnchereType', $enchere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($enchere);
            $em->flush();

            return $this->redirectToRoute('enchere_show', array('id' => $enchere->getId()));
        }

        return $this->render('enchere/new.html.twig', array(
            'enchere' => $enchere,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a enchere entity.
     *
     */
    public function showAction(Enchere $enchere)
    {
        $deleteForm = $this->createDeleteForm($enchere);

        return $this->render('enchere/show.html.twig', array(
            'enchere' => $enchere,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing enchere entity.
     *
     */
    public function editAction(Request $request, Enchere $enchere)
    {
        $deleteForm = $this->createDeleteForm($enchere);
        $editForm = $this->createForm('AppBundle\Form\EnchereType', $enchere);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enchere_edit', array('id' => $enchere->getId()));
        }

        return $this->render('enchere/edit.html.twig', array(
            'enchere' => $enchere,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a enchere entity.
     *
     */
    public function deleteAction(Request $request, Enchere $enchere)
    {
        $form = $this->createDeleteForm($enchere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($enchere);
            $em->flush();
        }

        return $this->redirectToRoute('enchere_index');
    }

    /**
     * Creates a form to delete a enchere entity.
     *
     * @param Enchere $enchere The enchere entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Enchere $enchere)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('enchere_delete', array('id' => $enchere->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
