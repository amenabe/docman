<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProjectsController extends AbstractController
{
    #[Route('/projects', name: 'app_projects')]
    public function index(): Response
    {
        if (!$this->getUser())
            return $this->redirectToRoute('app_userLogin');
        else
            return $this->render('projects/index.html.twig', [
                
            ]);
    }
}
