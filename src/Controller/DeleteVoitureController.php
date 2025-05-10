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

class DeleteVoitureController extends AbstractController
{

    #[Route('/admin/delete/{id}', name: 'app_admin_delete', methods: ['POST'])]
    public function delete(Request $request, Voiture $voiture, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voiture->getId(), $request->request->get('_token'))) {
            $em->remove($voiture);
            $em->flush();
            $this->addFlash('success', 'Voiture supprimée avec succès 🚗 !');
        }

        return $this->redirectToRoute('app_admin_list');
    }

}

