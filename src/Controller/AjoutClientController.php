<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class AjoutClientController extends AbstractController
{
    #[Route('/client/add', name: 'app_client_ajout', methods: ['GET', 'POST'])]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $client = new Client();  // Création d'un nouvel objet Client

        // Créer un formulaire pour ajouter un client
        $form = $this->createForm(ClientType::class, $client);

        $form->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Traitement de la photo (si elle est ajoutée)
            $photoFile = $form->get('photo')->getData();
            if ($photoFile) {
                $newFilename = uniqid() . '.' . $photoFile->guessExtension();

                // Déplacer le fichier dans le répertoire "uploads/photos"
                try {
                    $photoFile->move(
                        $this->getParameter('uploads_directory'),  // Assure-toi que ce paramètre est bien configuré
                        $newFilename
                    );
                    $client->setPhoto('uploads/photos/' . $newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur est survenue lors du téléchargement de la photo.');
                }
            }

            // Sauvegarder le client dans la base de données
            $em->persist($client);
            $em->flush();

            // Message flash de succès
            $this->addFlash('success', 'Client ajouté avec succès !');

            return $this->redirectToRoute('app_client_list');  // Rediriger vers la liste des clients
        }

        return $this->render('admin/pages/ajoutclient.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
