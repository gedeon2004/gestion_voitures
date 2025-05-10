<?php
namespace App\Controller;

use App\Entity\Voiture;
use App\Form\VoitureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class EditVoitureController extends AbstractController
{
    #[Route('/admin/edit/{id}', name: 'app_admin_edit')]
    public function edit(
        Request $request,
        Voiture $voiture,
        EntityManagerInterface $em,
        SluggerInterface $slugger
    ): Response {
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();
                
                $imageFile->move(
                    $this->getParameter('uploads_directory'),
                    $newFilename
                );
                
                // Supprime l'ancienne image si elle existe
                if ($voiture->getImage()) {
                    $oldImage = $this->getParameter('uploads_directory').'/'.$voiture->getImage();
                    if (file_exists($oldImage)) {
                        unlink($oldImage);
                    }
                }
                
                $voiture->setImage($newFilename);
            }

            $em->flush();
            $this->addFlash('success', 'Voiture mise à jour avec succès 🚗 !');
            return $this->redirectToRoute('app_admin_list');
        }

        return $this->render('admin/pages/edit.html.twig', [
            'form' => $form->createView(),
            'voiture' => $voiture // Passer la voiture au template
        ]);
    }
}