<?php

namespace App\Controller;

use App\Entity\Media;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\MimeTypes;
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

    /*
    #[Route('/media/file/{filename}', name: 'media_from_file')]
    public function mediaFromFile(EntityManagerInterface $entityManager, string $filename): Response
    {
        // 1. Check if user is logged in
        $user = $this->getUser();
        if (!$user) {
            throw $this->createAccessDeniedException();
        }

        // 2. Logic to verify if $filename belongs to $user...
        $rec = $entityManager->getRepository(Media::class)->findOneBy(['uuid' => $filename]);

        // 3. Just pretend the missing file is not accessible by this user
        if (!$rec) { 
            throw $this->createAccessDeniedException();
        }
        
        // 4. Serve it
        $fn = join(".", [$filename, $rec->getFileExt()]);
       
        $filepath = join(DIRECTORY_SEPARATOR, [$this->getParameter('kernel.project_dir'), 'var', 'storage', 'media', $user->getId() , $fn ]);

        if (!file_exists($filepath))
            throw $this->createAccessDeniedException();

        return new BinaryFileResponse($filepath);
    }
    */

    #[Route('/media/db/{id<\d+>}', name: 'media_from_db')]
    public function mediaFromDb(EntityManagerInterface $entityManager, int $id): Response
    {
        // 1. Check if user is logged in
        $user = $this->getUser();
        if (!$user) {
            throw $this->createAccessDeniedException();
        }

        // 2. Find the file's record from the db where this is user is the owner
         $rec = $entityManager->getRepository(Media::class)->findOneBy(['id' => $id, 'owner_id' => $user->getId()]);

        // 3. If file rec is not found, then this is not your file
        if (!$rec) {
            throw $this->createAccessDeniedException();
        }

        $binaryData = $rec->getFileData();

        if ($binaryData)
        {
            $ext = $rec->getFileExt();
            $mimeTypes = new MimeTypes();
            // Returns an array of MIME types associated with the extension (e.g., ['image/jpeg', 'image/pjpeg'])
            $types = $mimeTypes->getMimeTypes($ext);
            // Typically, you want the first/most common result
            $mime_type = $types[0] ?? null;

            $response = new Response(stream_get_contents($binaryData), 200);
            $response->headers->set('Content-Type', $mime_type);
            $response->headers->set('Content-Disposition', 'inline; filename="image.'.$ext.'"' );
            return $response;    
        }

        throw $this->createAccessDeniedException();
        
    }



}
