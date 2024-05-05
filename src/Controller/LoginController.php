<?php

namespace App\Controller;

use http\Env\Request;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportException;
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


    public function handleForm(Request $req){
        $loginForm = $this->createForm(LoginFormType::class);

    }


    public function sendEmail(MailerInterface $mailer,String $to='ahmed_00400@outlook.com',String $activation_code='1')
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
              <a href='http://localhost:8000/x/WebProject/login/activate.php?email=$to&code=$activation_code' style='font-size:26px;background-color: #4fa284; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>
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
