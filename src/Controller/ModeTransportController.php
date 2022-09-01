<?php

namespace App\Controller;

use App\Entity\ModeTransport;
use App\Form\ModeTransportType;
use App\Repository\ModeTransportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/transport")
 */
class ModeTransportController extends AbstractController
{
    /**
     * @Route("/", name="app_mode_transport_index", methods={"GET"})
     */
    public function index(ModeTransportRepository $modeTransportRepository): Response
    {
        return $this->render('mode_transport/index.html.twig', [
            'mode_transports' => $modeTransportRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_mode_transport_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ModeTransportRepository $modeTransportRepository): Response
    {
        $modeTransport = new ModeTransport();
        $form = $this->createForm(ModeTransportType::class, $modeTransport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $modeTransportRepository->add($modeTransport, true);

            return $this->redirectToRoute('app_mode_transport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mode_transport/new.html.twig', [
            'mode_transport' => $modeTransport,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_mode_transport_show", methods={"GET"})
     */
    public function show(ModeTransport $modeTransport): Response
    {
        return $this->render('mode_transport/show.html.twig', [
            'mode_transport' => $modeTransport,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_mode_transport_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ModeTransport $modeTransport, ModeTransportRepository $modeTransportRepository): Response
    {
        $form = $this->createForm(ModeTransportType::class, $modeTransport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $modeTransportRepository->add($modeTransport, true);

            return $this->redirectToRoute('app_mode_transport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mode_transport/edit.html.twig', [
            'mode_transport' => $modeTransport,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_mode_transport_delete", methods={"POST"})
     */
    public function delete(Request $request, ModeTransport $modeTransport, ModeTransportRepository $modeTransportRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$modeTransport->getId(), $request->request->get('_token'))) {
            $modeTransportRepository->remove($modeTransport, true);
        }

        return $this->redirectToRoute('app_mode_transport_index', [], Response::HTTP_SEE_OTHER);
    }
}
