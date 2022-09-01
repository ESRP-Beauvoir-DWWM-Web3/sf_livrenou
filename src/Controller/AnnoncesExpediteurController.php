<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Form\Annonces1Type;
use App\Repository\AnnoncesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/expediteur/annonces")
 */
class AnnoncesExpediteurController extends AbstractController
{
    /**
     * @Route("/", name="app_annonces_expediteur_index", methods={"GET"})
     */
    public function index(AnnoncesRepository $annoncesRepository): Response
    {
        return $this->render('annonces_expediteur/index.html.twig', [
            'annonces' => $annoncesRepository->findAll(),
        ]);
    }
    /**
     * @Route("/mesAnnonces", name="app_mesAnnonces_expediteur", methods={"GET"})
     */
    public function index_mesAnnonces(AnnoncesRepository $annoncesRepository): Response
    {
        return $this->render('annonces_expediteur/index.html.twig', [
            'annonces' => $annoncesRepository->findBy(['expediteur' => $this->getUser()]),
        ]);
    }

    /**
     * @Route("/new", name="app_annonces_expediteur_new", methods={"GET", "POST"})
     */
    public function new(Request $request, AnnoncesRepository $annoncesRepository): Response
    {
        $annonce = new Annonces();
        $form = $this->createForm(Annonces1Type::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annonce->setExpediteur($this->getUser());
            $annonce->setStatus('Libre');
            $annoncesRepository->add($annonce, true);

            return $this->redirectToRoute('app_annonces_expediteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('annonces_expediteur/new.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_annonces_expediteur_show", methods={"GET"})
     */
    public function show(Annonces $annonce): Response
    {
        return $this->render('annonces_expediteur/show.html.twig', [
            'annonce' => $annonce,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_annonces_expediteur_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Annonces $annonce, AnnoncesRepository $annoncesRepository): Response
    {
        $form = $this->createForm(Annonces1Type::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annoncesRepository->add($annonce, true);

            return $this->redirectToRoute('app_annonces_expediteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('annonces_expediteur/edit.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_annonces_expediteur_delete", methods={"POST"})
     */
    public function delete(Request $request, Annonces $annonce, AnnoncesRepository $annoncesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $annonce->getId(), $request->request->get('_token'))) {
            $annoncesRepository->remove($annonce, true);
        }

        return $this->redirectToRoute('app_annonces_expediteur_index', [], Response::HTTP_SEE_OTHER);
    }
}
