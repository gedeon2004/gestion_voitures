<?php

// src/Controller/HomeController.php
namespace App\Controller;
use App\Entity\Voiture;
use App\Form\VoitureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\VoitureRepository; 

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    // #[Route('/voitures', name: 'client_voitures')]
    // public function index(VoitureRepository $repo): Response
    // {
    //     $voitures = $repo->findBy(['isPublished' => true]);

    //     return $this->render('client/voitures.html.twig', [
    //         'voitures' => $voitures,
    //     ]);
    // }
}

 