<?php

namespace App\Controller;

use App\Repository\ConsultantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ConsultantsController extends AbstractController
{
    #[Route('/consultants', name: 'app_consultants')]
    public function index(ConsultantRepository $consultantRepository): Response
    {
        if (!$this->getUser())
            return $this->redirectToRoute('app_userLogin');
        else
            return $this->render('consultants/index.html.twig', [
                'consultants' => $consultantRepository->findAll(),
            ]);
    }
}
