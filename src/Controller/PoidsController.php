<?php

namespace App\Controller;

use App\Entity\Poids;
use App\Form\PoidsType;
use App\Repository\PoidsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/poids")
 */
class PoidsController extends AbstractController
{
    /**
     * @Route("/", name="app_poids_index", methods={"GET"})
     */
    public function index(PoidsRepository $poidsRepository): Response
    {
        return $this->render('poids/index.html.twig', [
            'poids' => $poidsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_poids_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PoidsRepository $poidsRepository): Response
    {
        $poid = new Poids();
        $form = $this->createForm(PoidsType::class, $poid);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $poidsRepository->add($poid, true);

            return $this->redirectToRoute('app_poids_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('poids/new.html.twig', [
            'poid' => $poid,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_poids_show", methods={"GET"})
     */
    public function show(Poids $poid): Response
    {
        return $this->render('poids/show.html.twig', [
            'poid' => $poid,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_poids_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Poids $poid, PoidsRepository $poidsRepository): Response
    {
        $form = $this->createForm(PoidsType::class, $poid);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $poid->setStatus("actif");
            $poidsRepository->add($poid, true);

            return $this->redirectToRoute('app_poids_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('poids/edit.html.twig', [
            'poid' => $poid,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_poids_delete", methods={"POST"})
     */
    public function delete(Request $request, Poids $poid, PoidsRepository $poidsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$poid->getId(), $request->request->get('_token'))) {
            $poidsRepository->remove($poid, true);
        }

        return $this->redirectToRoute('app_poids_index', [], Response::HTTP_SEE_OTHER);
    }
}
