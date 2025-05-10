<?php
// src/Controller/AdminController.php
namespace App\Controller;


use App\Entity\Voiture;
use App\Form\VoitureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VoitureRepository; 

class ListVoitureController extends AbstractController
{

    #Routes pour retourner la liste des voitures
    #[Route('/admin/list', name: 'app_admin_list')]
    public function list(VoitureRepository $voitureRepository): Response
    {
        $voitures = $voitureRepository->findAll();

        return $this->render('admin/pages/list.html.twig', [
            'voitures' => $voitures,
        ]);
    }
}

