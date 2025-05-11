<?php
// src/Controller/AdminController.php
namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClientRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ListClientController extends AbstractController
{
    #[Route('/admin/clients', name: 'app_client_list')]
    public function list(Request $request, ClientRepository $clientRepository): Response
    {
        // Création du formulaire de recherche
        $searchForm = $this->createFormBuilder()
            ->add('cni', TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Rechercher par numéro CNI...',
                    'class' => 'form-control'
                ]
            ])
            ->getForm();

        $clients = $clientRepository->findAll();

        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $cni = $searchForm->get('cni')->getData();
            $clients = $clientRepository->findBy(['cni' => $cni]);
        }

        return $this->render('admin/pages/listclient.html.twig', [
            'clients' => $clients,
            'searchForm' => $searchForm->createView() 
        ]);
    }
}