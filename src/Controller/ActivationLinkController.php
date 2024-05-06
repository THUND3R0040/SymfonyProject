<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActivationLinkController extends AbstractController
{
    #[Route('/activationLink', name: 'app_activation_link')]
    public function index(Request $req,ManagerRegistry $doctrine): Response
    {
        $email = $req->get('email');
        $users = $doctrine->getRepository(User::class)->findBy(['u_email'=>$email]);

        $user = $users[0];
        $user->setIsActive(1);

        $manager = $doctrine->getManager();
        $manager->persist($user);
        $manager->flush();


        return $this->render('activation_link/index.html.twig');
    }
}
