<?php
// src/Controller/AdminController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPagesController extends AbstractController
{
    #[Route('/admin/widgets', name: 'admin_widgets')]
    public function widgets(): Response
    {
        return $this->render('admin/widgets.html.twig');
    }

    #[Route('/admin/layout-options', name: 'admin_layout_options')]
    public function layoutOptions(): Response
    {
        return $this->render('admin/layout_options.html.twig');
    }

    #[Route('/admin/ui-elements', name: 'admin_ui_elements')]
    public function uiElements(): Response
    {
        return $this->render('admin/ui_elements.html.twig');
    }

    #[Route('/admin/forms', name: 'admin_forms')]
    public function forms(): Response
    {
        return $this->render('admin/forms.html.twig');
    }

    #[Route('/admin/tables', name: 'admin_tables')]
    public function tables(): Response
    {
        return $this->render('admin/tables.html.twig');
    }
}