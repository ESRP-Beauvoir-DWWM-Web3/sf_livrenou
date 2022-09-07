<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Form\AnnoncesType;
use App\Form\AnnoncesChoiceType;
use App\Form\AnnoncesValidLivType;
use App\Form\AnnoncesValidationType;
use App\Repository\AnnoncesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/annonces")
 */
class AnnoncesController extends AbstractController
{
    /**
     * @Route("/", name="app_annonces_index", methods={"GET"})
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_EXPEDITEUR')")
     */
    public function index(AnnoncesRepository $annoncesRepository): Response
    {
        return $this->render('annonces/index.html.twig', [
            'annonces' => $annoncesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_annonces_new", methods={"GET", "POST"})
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_EXPEDITEUR')")
     */
    public function new(Request $request, AnnoncesRepository $annoncesRepository): Response
    {
        $annonce = new Annonces();
        $form = $this->createForm(AnnoncesType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annoncesRepository->add($annonce, true);

            return $this->redirectToRoute('app_annonces_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('annonces/new.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_annonces_show", methods={"GET"})
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_EXPEDITEUR')")
     */
    public function show(Annonces $annonce): Response
    {
        return $this->render('annonces/show.html.twig', [
            'annonce' => $annonce,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_annonces_edit", methods={"GET", "POST"})
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_EXPEDITEUR')")
     */
    public function edit(Request $request, Annonces $annonce, AnnoncesRepository $annoncesRepository): Response
    {
        $form = $this->createForm(AnnoncesType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annoncesRepository->add($annonce, true);

            return $this->redirectToRoute('app_annonces_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('annonces/edit.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_annonces_delete", methods={"POST"})
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_EXPEDITEUR')")
     */
    public function delete(Request $request, Annonces $annonce, AnnoncesRepository $annoncesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $annonce->getId(), $request->request->get('_token'))) {
            $annoncesRepository->remove($annonce, true);
        }

        return $this->redirectToRoute('app_annonces_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/{id}/choice", name="app_annonces_choice", methods={"GET", "POST"})
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_LIVREUR')")
     */
    public function choice(Request $request, Annonces $annonce, AnnoncesRepository $annoncesRepository): Response
    {
        $form = $this->createForm(AnnoncesChoiceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annonce->setStatus('pris en charge');
            $annonce->setLivreur($this->getUser());
            $annoncesRepository->add($annonce, true);

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('home/show.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
        ]);
    }
    /**
     * @Route("/{id}/validation", name="app_annonces_validation", methods={"GET", "POST"})
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_EXPEDITEUR')")
     */
    public function validation(Request $request, Annonces $annonce, AnnoncesRepository $annoncesRepository): Response
    {
        $form = $this->createForm(AnnoncesValidationType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('status')->getData() == 'Libre') {
                $annonce->setLivreur(null);
            }
            $annoncesRepository->add($annonce, true);

            return $this->redirectToRoute('app_annonces_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('home/showExpediteur.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
        ]);
    }
    /**
     * @Route("/{id}/ValidDeliver", name="app_annonces_colis_livre", methods={"GET", "POST"})
     */
    public function colis_livre(Request $request, Annonces $annonce, AnnoncesRepository $annoncesRepository): Response
    {
        $form = $this->createForm(AnnoncesValidLivType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annonce->setStatus('Colis livre');
            $annonce->setLivreur($this->getUser());
            $annoncesRepository->add($annonce, true);

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('home/show.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
        ]);
    }
}
