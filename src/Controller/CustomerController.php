<?php

namespace App\Controller;

use App\Form\UserEditType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

 /**
     * @Route("/profile")
     */
class CustomerController extends AbstractController
{
    private UserRepository $repo;
    private Security $security;
    public function __construct(UserRepository $repo, Security $security)
    {
        $this ->repo = $repo;
        $this->security  = $security;
    }

    /**
     * @Route("/", name="cus_profile")
     */
    public function proAction(): Response
    {
        $user = $this->security->getUser();
        return $this->render('customer/index.html.twig', [
            'user' => $user
        ]);

        // return $this->json($userForm);
    }

    /**
     * @Route("/editer", name="cus_edit")
     */
    public function editAction(Request $req,  UserRepository $repo): Response
    {
        $user = $this->getUser();
        $userForm = $this->createForm(UserEditType::class, $user);
        $userForm->handleRequest($req);
        
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $repo->save($user, true);
            return $this->redirectToRoute('cus_profile', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("customer/edit.html.twig", [
            'userForm' => $userForm->createView()
        ]);
    }
    
}
