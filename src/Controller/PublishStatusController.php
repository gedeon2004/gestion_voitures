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

class PublishStatusController extends AbstractController
{

    #[Route('/admin/toggle-publish/{id}', name: 'app_admin_toggle_publish')]
    public function togglePublish(Voiture $voiture, EntityManagerInterface $em): Response
    {
        $voiture->setIsPublished(!$voiture->isPublished());
        $em->flush();

        $message = $voiture->isPublished() ? 'Voiture publiée ✅ !' : 'Voiture dépubliée 🚫 !';
        $this->addFlash('success', $message);

        return $this->redirectToRoute('app_admin_list');
    }

}

