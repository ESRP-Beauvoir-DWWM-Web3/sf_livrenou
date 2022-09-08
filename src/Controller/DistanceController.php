<?php

namespace App\Controller;

use App\Entity\Distance;
use App\Form\DistanceType;
use App\Repository\DistanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/distance")
 */
class DistanceController extends AbstractController
{
    /**
     * @Route("/", name="app_distance_index", methods={"GET"})
     */
    public function index(DistanceRepository $distanceRepository): Response
    {
        return $this->render('distance/index.html.twig', [
            'distances' => $distanceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_distance_new", methods={"GET", "POST"})
     */
    public function new(Request $request, DistanceRepository $distanceRepository): Response
    {
        $distance = new Distance();
        $form = $this->createForm(DistanceType::class, $distance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $distance->setIsActive(true);
            $distanceRepository->add($distance, true);

            return $this->redirectToRoute('app_distance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('distance/new.html.twig', [
            'distance' => $distance,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_distance_show", methods={"GET"})
     */
    public function show(Distance $distance): Response
    {
        return $this->render('distance/show.html.twig', [
            'distance' => $distance,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_distance_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Distance $distance, DistanceRepository $distanceRepository): Response
    {
        $form = $this->createForm(DistanceType::class, $distance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $distanceRepository->add($distance, true);

            return $this->redirectToRoute('app_distance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('distance/edit.html.twig', [
            'distance' => $distance,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_distance_delete", methods={"POST"})
     */
    public function delete(Request $request, Distance $distance, DistanceRepository $distanceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$distance->getId(), $request->request->get('_token'))) {
            $distanceRepository->remove($distance, true);
        }

        return $this->redirectToRoute('app_distance_index', [], Response::HTTP_SEE_OTHER);
    }
}
