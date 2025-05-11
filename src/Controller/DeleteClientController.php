<?php

namespace App\Controller;

use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DeleteClientController extends AbstractController
{
    #[Route('/admin/client/delete/{id}', name: 'app_client_delete', methods: ['GET'])]
    public function delete(Client $client, EntityManagerInterface $em): Response
    {
        $em->remove($client);
        $em->flush();
        $this->addFlash('success', 'Client supprimé avec succès.');
    
        return $this->redirectToRoute('app_client_list');
    }
    
}