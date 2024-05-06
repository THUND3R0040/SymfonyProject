<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\throwException;


class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]

    public function index(MailerInterface $mailer): Response
    {
        //retrieving the login page
        return $this->render('login/index.html.twig');
    }


    /**
     * @throws RandomException
     */
    #[Route('/registerUser',name: 'registerUser')]
    public function registerUser(Request $req, ManagerRegistry $doctrine,SessionInterface $session,MailerInterface $mailer):Response{
        $name = $req->get('name');
        $email = $req->get('email');
        $password = password_hash($req->get('password'), PASSWORD_BCRYPT);
        $date = new \DateTime();

        $users = $doctrine->getRepository(User::class)->findBy(['u_email'=>$req->get('email')]);

        if(sizeof($users)!=0){
            $session->getFlashBag()->add('emailAlreadyUsed','Email is already used');
            return $this->redirectToRoute('app_login');
        }



        $user = new User();
        $user->setUEmail($email);
        $user->setIsActive(0);
        $user->setIsAdmin(0);
        $user->setRegDate($date);
        $user->setUPassword($password);
        $user->setUName($name);

        $manager = $doctrine->getManager();
        $manager->persist($user);
        $manager->flush();
        $session->getFlashBag()->add('success', 'An activation Link has been sent to your Email');
        $this->sendEmail($mailer,$email,bin2hex(random_bytes(16)));
        return $this->redirectToRoute('app_login');
    }

    #[Route('/signin', name: 'signin')]
    public function signin(ManagerRegistry $doctrine,SessionInterface $session,Request $req):Response{

        $users = $doctrine->getRepository(User::class)->findBy(['u_email'=>$req->get('email')]);

        if(sizeof($users)==0){
            $session->getFlashBag()->add('invalidMailOrPassword','invalid Email or Password');
            return $this->redirectToRoute('app_login');
        }
        else{
            if(password_verify($req->get('password'),$users[0]->getUPassword())){
                if($users[0]->getIsActive()==1){
                    $session = $req->getSession();
                    $session->set('u_email',$req->get('email'));
                    $session->set('u_name',$users[0]->getUName());
                    $session->set('isAdmin',$users[0]->getIsAdmin());
                    return $this->redirectToRoute('app_productPage');
                }
                else{
                    $session->getFlashBag()->add('notActiveAlert','Account is not active');
                    return $this->redirectToRoute('app_login');
                }
            }
            else{
                $session->getFlashBag()->add('invalidMailOrPassword','invalid Mail Or Password');
                return $this->redirectToRoute('app_login');
            }


        }

    }


    public function sendEmail(MailerInterface $mailer,String $to,String $activation_code)
    {
        $email = (new Email())
            ->from('ahmed_00400@outlook.com')
            ->to($to)
            ->subject('Nouveau message')
            ->html("<!DOCTYPE html>
    <html lang='en'>
    <head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    </head>
    <body>
      <table width='100%' cellspacing='0' cellpadding='0' style='max-width: 600px; margin: auto;'>
        <tr>
          <td style='background-color: #4fa284; padding: 10px; text-align: center; color: white;'>
            <h1 style='font-size: 24px;'>ClickShop</h1>
            <img src='cid:logo' alt='ClickShop' width='100' height='100'>
          </td>
        </tr>
        <tr>
          <td style='padding: 20px; text-align: center;'>
            <p style='font-size: 16px; color: #555;'>
              Hello,
            </p>
            <p style='font-size: 16px; color: #555;'>
              Thank you for registering with us. Please click the button below to activate your account.
            </p>
            <p style='margin: 30px 0;'>
              <!-- The link should lead to the activation URL -->
              <a href='http://localhost:8000/activationLink?email=$to&code=$activation_code' style='font-size:26px;background-color: #4fa284; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>
                Activate Account
              </a>
            </p>
            <p style='font-size: 16px; color: #555;'>
              If you did not request this, please ignore this email.
            </p>
          </td>
        </tr>
        <tr>
          <td style='background-color: #333; padding: 10px; text-align: center; color: white;'>
            <p style='font-size: 14px;'>
              &copy; 2024 ClickShop . All rights reserved.
            </p>
          </td>
        </tr>
      </table>
    </body>
    </html>");

        try{
            $mailer->send($email);
        }
        catch (TransportExceptionInterface $e){
            throwException($e);
        }
    }


}
