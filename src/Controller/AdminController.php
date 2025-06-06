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

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]

    public function index(): Response
    {
        
        return $this->render('admin/index.html.twig');
    }
    
}
