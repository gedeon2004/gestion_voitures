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

class AjoutVoitureController extends AbstractController
{

    #Route pour retourner l'ajout
    #[Route('/admin/ajout', name: 'app_admin_ajout')]
    public function ajout(Request $request, EntityManagerInterface $em): Response
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Traitement de l'image
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $newFilename = uniqid().'.'.$imageFile->guessExtension();
                $imageFile->move($this->getParameter('uploads_directory'), $newFilename);
                $voiture->setImage($newFilename);
            }

            // Enregistrement dans la BDD
            $em->persist($voiture);
            $em->flush();

             // AJOUT du message flash :
            $this->addFlash('success', 'Voiture enregistrée avec succès  !');

            return $this->redirectToRoute('app_admin_list');
        }

        return $this->render('admin/pages/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}