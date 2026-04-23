<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\UserEditFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\MimeTypes;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController
{
    #[Route(path: '/user/login', name: 'app_userLogin')]
    public function userLogin(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/user/register', name: 'app_userRegister')]
    public function userRegister(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();

            // encode the plain password
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));

            // Process the uploaded image file
            $picFile = $form->get('picture')->getData();
            if ($picFile) {
                //$origFilename = $picFile->getClientOriginalName();
                //$newFilename = uniqid(true).'.'.$picFile->guessExtension();
                $binaryData = file_get_contents($picFile->getPathname());
                $user->setPicType($picFile->guessExtension());
                $user->setPicture($binaryData);
            }

            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_userLogin');
        }

        return $this->render('security/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }

    #[Route('/user/edit', name: 'app_userEdit')]
    public function userEdit(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserEditFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Process the password
            $plainPassword = $form->get('plainPassword')->getData();
            // Only save a non-blank plainPassword with a valid length
            if ($plainPassword) {
                $hashedPassword = $userPasswordHasher->hashPassword(
                    $user,
                    $plainPassword
                );
                $user->setPassword($hashedPassword);
            }
            
            // Process the uploaded image file
            $picFile = $form->get('picture')->getData();
            if ($picFile) {
                //$origFilename = $picFile->getClientOriginalName();
                //$newFilename = uniqid(true).'.'.$picFile->guessExtension();
                $binaryData = file_get_contents($picFile->getPathname());
                $user->setPicType($picFile->guessExtension());
                $user->setPicture($binaryData);
            }

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_userLogout');
        }

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
        
        return $this->render('security/edit.html.twig', [
            'usereditForm' => $form,
            'mime_type' => $mime_type,
            'image_data' => $image_data
        ]);
    }



    #[Route(path: '/user/logout', name: 'app_userLogout')]
    public function userLogout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
