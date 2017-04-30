<?php

namespace eJobsBundle\Controller;

use eJobsBundle\Entity\Job;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('eJobsBundle:Default:index.html.twig');
    }

    /**
     * Creates a new job entity.
     *
     * @Route("/adauga-job", name="jobs_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $job = new Job();
        $form = $this->createForm('eJobsBundle\Form\JobType', $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $job->setUser($this->getUser());
            $em->persist($job);
            $em->flush();

            $this->addFlash(
                'notice',
                "Jobul a fost postat corect"
            );
            return $this->redirectToRoute('jobs_index');
        }

        return $this->render('job/new.html.twig', array(
            'job' => $job,
            'form' => $form->createView(),
        ));
    }
}
