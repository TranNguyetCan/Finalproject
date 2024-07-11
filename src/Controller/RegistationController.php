<?php

namespace App\Controller;

use App\Entity\Paypal;
use App\Entity\User;
use App\Form\PaypalType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistationController extends AbstractController
{
    /**
     * @Route("/register", name="signin_page")
     */
    public function register(
        Request $req,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager
    ): Response {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            //encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            
            $user->setRoles(['ROLE_USER']);

            // THe purposr use insert and update
            $entityManager->persist($user);
            $entityManager->flush();

            //  do anything eslse you nedd here, like send and email

            return $this->redirectToRoute('logIn_page');
        }
        return $this->render('registation/register.html.twig', [
            'registrationForm' => $form->createView()
        ]);
        // return $this->redirectToRoute('signIn_page');

    }

   /**
     * @Route("/signin", name="signIn")
     */
    public function signIn(
        Request $req,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager
    ): Response {
        $paypal = new User();
        $paypalForm = $this->createForm(UserType::class, $paypal);
        $paypalForm->handleRequest($req);

        if ($paypalForm->isSubmitted() && $paypalForm->isValid()) {
            //encode the plain password
            $paypal->setPassword(
                $userPasswordHasher->hashPassword(
                    $paypal,
                    $paypalForm->get('password')->getData()
                )
            );
            
            

            // THe purposr use insert and update
            $entityManager->persist($paypal);
            $entityManager->flush();

            //  do anything eslse you nedd here, like send and email

            return $this->redirectToRoute('paypal_login');
        }
        return $this->render('payment/signIn.html.twig', [
            'paypalForm' => $paypalForm->createView(),
        ]);
        // return $this->redirectToRoute('signIn_page');

    }
}
