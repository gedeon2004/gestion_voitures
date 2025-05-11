<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;  // Formulaire pour éditer un client
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class EditClientController extends AbstractController
{
    #[Route('/admin/client/edit/{id}', name: 'app_client_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Client $client, EntityManagerInterface $em): Response
    {
        // Créer un formulaire pour modifier les informations du client
        $form = $this->createForm(ClientType::class, $client);

        $form->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Traitement de la photo (si elle est modifiée)
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

            // Sauvegarder les modifications dans la base de données
            $em->flush();

            // Message flash de succès
            $this->addFlash('success', 'Client mis à jour avec succès !');

            return $this->redirectToRoute('app_client_list');
        }

        return $this->render('admin/pages/editclient.html.twig', [
            'form' => $form->createView(),
            'client' => $client,
        ]);
    }
}
