<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Commentario;
use AppBundle\Entity\Tema;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Commentario controller.
 *
 * @Route("comentario")
 */
class CommentarioController extends Controller
{
    /**
     * Lists all commentario entities.
     *
     * @Route("/", name="comentario_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commentarios = $em->getRepository('AppBundle:Commentario')->findAll();

        return $this->render('commentario/index.html.twig', array(
            'commentarios' => $commentarios,
        ));
    }

    /**
     * Creates a new commentario entity.
     *
     * @Route("/{slug}/new", name="comentario_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Tema $tema)
    {
        $commentario = new Commentario();

        $tema->addComentario($commentario);
        $commentario->setHost($request->getClientIp());

        $form = $this->createForm('AppBundle\Form\CommentarioType', $commentario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentario);
            $em->flush();

            return $this->redirectToRoute('tema_show', array('slug' => $tema->getSlug()));
        }

        return $this->render('commentario/new.html.twig', array(
            'commentario' => $commentario,
            'tema' => $tema,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a commentario entity.
     *
     * @Route("/{id}", name="comentario_show")
     * @Method("GET")
     */
    public function showAction(Commentario $commentario)
    {
        $deleteForm = $this->createDeleteForm($commentario);

        return $this->render('commentario/show.html.twig', array(
            'commentario' => $commentario,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing commentario entity.
     *
     * @Route("/{id}/edit", name="comentario_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Commentario $commentario)
    {
        $deleteForm = $this->createDeleteForm($commentario);
        $editForm = $this->createForm('AppBundle\Form\CommentarioType', $commentario);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('comentario_edit', array('id' => $commentario->getId()));
        }

        return $this->render('commentario/edit.html.twig', array(
            'commentario' => $commentario,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a commentario entity.
     *
     * @Route("/{id}", name="comentario_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Commentario $commentario)
    {
        $form = $this->createDeleteForm($commentario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commentario);
            $em->flush();
        }

        return $this->redirectToRoute('comentario_index');
    }

    /**
     * Creates a form to delete a commentario entity.
     *
     * @param Commentario $commentario The commentario entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Commentario $commentario)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('comentario_delete', array('id' => $commentario->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
