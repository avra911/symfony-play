<?php

namespace eJobsBundle\Controller;

use eJobsBundle\Entity\Job;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Job controller.
 *
 * @Route("jobs")
 */
class JobController extends Controller
{
    /**
     * Lists all specific user job entities.
     *
     * @Route("/own", name="jobs_own")
     * @Method("GET")
     */
    public function ownAction()
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();

        $jobs = $qb->select(array('j'))
            ->from('eJobsBundle:Job', 'j')
            ->where('j.user = :userId')
            ->setParameter('userId', $this->getUser()->getId())
            ->getQuery()
            ->getResult();

        return $this->render('job/own.html.twig', array(
            'jobs' => $jobs,
        ));
    }

    /**
     * Lists all job entities.
     *
     * @Route("/", name="jobs_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();

        $now = new \DateTime;
        $to = new \DateTime("+1 months");

        $jobs = $qb->select(array('j'))
            ->from('eJobsBundle:Job', 'j')
            ->where('j.esteActiv = :esteActiv and ' . $qb->expr()->between(
                'j.dataPublicarii',
                ':from',
                ':to'
            ))
            ->setParameters(array(
                'esteActiv' => true,
                'from' => $now->format("Y-m-d"),
                'to' => $to->format("Y-m-d"),
            ))
            ->getQuery()
            ->getResult();

        return $this->render('job/index.html.twig', array(
            'jobs' => $jobs,
        ));
    }

    /**
     * Finds and displays a job entity.
     *
     * @Route("/{id}", name="jobs_show")
     * @Method("GET")
     */
    public function showAction(Job $job)
    {
        $deleteForm = $this->createDeleteForm($job);

        return $this->render('job/show.html.twig', array(
            'job' => $job,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing job entity.
     *
     * @Route("/{id}/edit", name="jobs_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Job $job)
    {
        if ($this->getUser()->getId() != $job->getUser()->getId()) {
            throw $this->createAccessDeniedException();
        }

        $deleteForm = $this->createDeleteForm($job);
        $editForm = $this->createForm('eJobsBundle\Form\JobType', $job);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('jobs_edit', array('id' => $job->getId()));
        }

        return $this->render('job/edit.html.twig', array(
            'job' => $job,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a job entity.
     *
     * @Route("/{id}", name="jobs_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Job $job)
    {
        if ($this->getUser()->getId() != $job->getUser()->getId()) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createDeleteForm($job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($job);
            $em->flush();
        }

        return $this->redirectToRoute('jobs_index');
    }

    /**
     * Creates a form to delete a job entity.
     *
     * @param Job $job The job entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Job $job)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('jobs_delete', array('id' => $job->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
