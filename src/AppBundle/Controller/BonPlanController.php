<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BonPlan;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Bonplan controller.
 *
 */
class BonPlanController extends Controller
{
    /**
     * Lists all bonPlan entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bonPlans = $em->getRepository('AppBundle:BonPlan')->findAll();

        return $this->render('bonplan/index.html.twig', array(
            'bonPlans' => $bonPlans,
        ));
    }

    /**
     * Creates a new bonPlan entity.
     *
     */
    public function newAction(Request $request)
    {
        $bonPlan = new Bonplan();
        $form = $this->createForm('AppBundle\Form\BonPlanType', $bonPlan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bonPlan);
            $em->flush();

            return $this->redirectToRoute('bonplan_show', array('id' => $bonPlan->getId()));
        }

        return $this->render('bonplan/new.html.twig', array(
            'bonPlan' => $bonPlan,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a bonPlan entity.
     *
     */
    public function showAction(BonPlan $bonPlan)
    {
        $deleteForm = $this->createDeleteForm($bonPlan);

        return $this->render('bonplan/show.html.twig', array(
            'bonPlan' => $bonPlan,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing bonPlan entity.
     *
     */
    public function editAction(Request $request, BonPlan $bonPlan)
    {
        $deleteForm = $this->createDeleteForm($bonPlan);
        $editForm = $this->createForm('AppBundle\Form\BonPlanType', $bonPlan);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bonplan_edit', array('id' => $bonPlan->getId()));
        }

        return $this->render('bonplan/edit.html.twig', array(
            'bonPlan' => $bonPlan,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a bonPlan entity.
     *
     */
    public function deleteAction(Request $request, BonPlan $bonPlan)
    {
        $form = $this->createDeleteForm($bonPlan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bonPlan);
            $em->flush();
        }

        return $this->redirectToRoute('bonplan_index');
    }

    /**
     * Creates a form to delete a bonPlan entity.
     *
     * @param BonPlan $bonPlan The bonPlan entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BonPlan $bonPlan)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bonplan_delete', array('id' => $bonPlan->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
