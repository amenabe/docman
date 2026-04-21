<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ContractorsController extends AbstractController
{
    #[Route('/contractors', name: 'app_contractors')]
    public function index(): Response
    {
        if (!$this->getUser())
            return $this->redirectToRoute('app_userLogin');
        else
            return $this->render('contractors/index.html.twig', [
                
            ]);
    }
}
