<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mime\MimeTypes;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $user = $this->getUser();

        if (!$user)
            return $this->redirectToRoute('app_userLogin');
        else {
            // Also, pass the current user's photo to the form rendered
            $image_data = null;
            $mime_type = null;
            
            $photo = $user->getPicture();
            if ($photo) {
                $image_data = base64_encode(stream_get_contents($photo));
                
                $mimeTypes = new MimeTypes();
                // Returns an array of MIME types associated with the extension (e.g., ['image/jpeg', 'image/pjpeg'])
                $types = $mimeTypes->getMimeTypes($user->getPicType());
                // Typically, you want the first/most common result
                $mime_type = $types[0] ?? null;
            }

            return $this->render('home/index.html.twig', [
                'mime_type' => $mime_type,
                'image_data' => $image_data
            ]);
        }
    }
}
