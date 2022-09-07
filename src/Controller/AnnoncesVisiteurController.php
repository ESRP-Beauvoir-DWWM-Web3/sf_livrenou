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
 * @Route("/visiteur/annonces")
 */
class AnnoncesVisiteurController extends AbstractController
{
    /**
     * @Route("/", name="app_annonces_visiteur_index", methods={"GET"})
     */
    public function index(AnnoncesRepository $annoncesRepository): Response
    {
        return $this->render('annonces_visiteur/index.html.twig', [
            'annonces' => $annoncesRepository->findBy(['status' => 'Libre'], ['date_livraison' => 'DESC']),
        ]);
    }
}
