<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SubstationsController extends AbstractController
{
    #[Route('/substations', name: 'app_substations')]
    public function index(): Response
    {
        if (!$this->getUser())
            return $this->redirectToRoute('app_userLogin');
        else
            return $this->render('substations/index.html.twig', [
                
            ]);
    }
}
