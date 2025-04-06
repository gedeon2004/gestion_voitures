<?php
// src/Controller/AdminController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]

    public function index(): Response
    {
        // Remarque que tu dois spécifier le chemin correct pour le fichier Twig
        return $this->render('admin/pages/index.html.twig');
    }
}
