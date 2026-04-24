<?php

namespace App\Controller;

use App\Entity\Media;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MediaController extends AbstractController
{
    #[Route('/media', name: 'app_media')]
    public function index(): Response
    {
        return $this->render('media/index.html.twig', [
            'controller_name' => 'MediaController',
        ]);
    }

    #[Route('/media/{filename}', name: 'app_media_server')]
    public function mediaServe(EntityManagerInterface $entityManager, string $filename)
    {
        // 1. Check if user is logged in
        $user = $this->getUser();
        if (!$user) {
            throw $this->createAccessDeniedException();
        }

        // 2. Logic to verify if $filename belongs to $user...
        $rec = $entityManager->getRepository(Media::class)->findOneBy(['uuid' => $filename]);

        // 3. Just pretend the missing file is not accessible by this user
        if (!$rec) { throw $this->createAccessDeniedException(); }
        
        // 4. Serve it
        $fn = join(".", [$filename, $rec->getFnExt()]);
        $filepath = join(DIRECTORY_SEPARATOR, [$this->getParameter('kernel.project_dir'), 'var', 'storage', 'media', $user->getId() , $fn ]);
        return new BinaryFileResponse($filepath);
    }

    

}
