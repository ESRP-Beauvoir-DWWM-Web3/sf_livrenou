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
 * @Route("/livreur/annonces")
 */
class AnnoncesLivreurController extends AbstractController
{
    /**
     * @Route("/", name="app_annonces_livreur_index", methods={"GET"})
     */
    public function index(AnnoncesRepository $annoncesRepository): Response
    {
        return $this->render('annonces_livreur/index.html.twig', [
            'annonces' => $annoncesRepository->findAll(),
        ]);
    }
}
