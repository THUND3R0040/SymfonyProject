<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;


class UserInterfaceController extends AbstractController
{
    #[Route('/userInterface', name: 'user.interface')]
    public function index(): Response
    {
        return $this->render('user_interface/index.html.twig', [
            'controller_name' => 'UserInterfaceController',
        ]);
    }

    #[Route('/modify', name: 'user.modify')]
    public function modify(Request $request, ManagerRegistry $doctrine, EntityManagerInterface $entityManagerInterface): Response {
        $session = $request->getSession();
        $email = $session->get('u_email');
        $realPassword = $session->get('u_pw');
        $enteredPassword = $request->get('password');
        $newName = $request->get('name');
        $newPassword = $request->get('new-password');
        $newEmail = $request->get('email');

        if (password_verify($enteredPassword, $realPassword)) {
            $user = $doctrine->getRepository(User::class)->findOneBy(['u_email' => $email]);
            
            if ($newName !== null) {
                $user->setUName($newName);
                $entityManagerInterface->flush();
                $this->addFlash('modify', 'Name changed successfully');

            } elseif ($newEmail !== null) {
                $user->setUEmail($newEmail);
                $entityManagerInterface->flush();
                $this->addFlash('modify', 'Email changed successfully');

            } elseif ($newPassword !== null) {
                $user->setUPassword(password_hash($newPassword, PASSWORD_BCRYPT));
                $entityManagerInterface->flush();
                $this->addFlash('modify', 'Password changed successfully');

            }

            } else {
                $this->addFlash('error', 'Invalid password, try again.');

            }
            
        
    
        return $this->redirectToRoute('user.interface');
    }

    #[Route('/logout', name: 'user.logout')]
    public function logout(Request $request): Response
    {
        $request->getSession()->invalidate();
        return $this->redirectToRoute('app_login');
    }
    
}
