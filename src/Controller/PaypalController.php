<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class PaypalController extends AbstractController
{
    // /**
    //  * @Route("/Payments", name="paypal_login")
    //  */
    // public function PaypalLogin(AuthenticationUtils $authenticationUtils): Response
    // {   
    //     $error = $authenticationUtils->getLastAuthenticationError();
    //     $email = $authenticationUtils->getEmail();
       

    //     return $this->render('payment/login.html.twig', [
    //         'emai;' =>$email, 'error' =>$error
    //     ]);
    // }
    
}
