<?php
// src/Controller/AdminController.php

namespace App\Controller;

use App\Entity\Client;
use App\Form\SearchClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListClientController extends AbstractController
{
    #[Route('/admin/clients', name: 'app_client_list')]
    public function list(
        Request $request,
        ClientRepository $clientRepository
    ): Response {
        // Création du formulaire de recherche
        $searchForm = $this->createForm(SearchClientType::class);
        $searchForm->handleRequest($request);

        $clients = [];

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $searchData = $searchForm->getData();
            
            // Recherche avec tous les critères
            $clients = $clientRepository->searchClients(
                $searchData['cni'] ?? null,
                $searchData['nom'] ?? null,
                $searchData['dateMin'] ?? null,
                $searchData['dateMax'] ?? null
            );
            
            // Message si aucun résultat
            if (empty($clients)) {
                $this->addFlash('info', 'Aucun client trouvé avec ces critères.');
            }
        } else {
            // Par défaut, afficher tous les clients
            $clients = $clientRepository->findAll();
        }

        return $this->render('admin/pages/listclient.html.twig', [
            'clients' => $clients,
            'searchForm' => $searchForm->createView(),
        ]);
    }


}