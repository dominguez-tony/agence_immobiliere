<?php

namespace App\Controller\Admin;

use App\Entity\Opt;
use App\Form\OptType;
use App\Repository\OptRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/opt")
 */
class AdminOptController extends AbstractController
{
    /**
     * @Route("/", name="admin.opt.index", methods={"GET"})
     */
    public function index(OptRepository $optRepository): Response
    {
        return $this->render('admin/opt/index.html.twig', [
            'opts' => $optRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin.opt.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $opt = new Opt();
        $form = $this->createForm(OptType::class, $opt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($opt);
            $entityManager->flush();

            return $this->redirectToRoute('admin.opt.index');
        }

        return $this->render('admin/opt/new.html.twig', [
            'opt' => $opt,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}/edit", name="admin.opt.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Opt $opt): Response
    {
        $form = $this->createForm(OptType::class, $opt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin.opt.index');
        }

        return $this->render('admin/opt/edit.html.twig', [
            'opt' => $opt,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.opt.delete", methods={"DELETE"})
     */
    public function delete(Request $request, Opt $opt): Response
    {
        if ($this->isCsrfTokenValid('admin/delete'.$opt->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($opt);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin.opt.index');
    }
}
