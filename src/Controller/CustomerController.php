<?php

namespace App\Controller;

use App\Form\UserEditType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/profile")
 */
class CustomerController extends AbstractController
{
    private UserRepository $repo;
    private Security $security;
    public function __construct(UserRepository $repo, Security $security)
    {
        $this->repo = $repo;
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
    public function editAction(Request $req,  UserRepository $repo, SluggerInterface $slugger): Response
    {
        $user = $this->getUser();
        $userForm = $this->createForm(UserEditType::class, $user);
        $userForm->handleRequest($req);

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            //update avatar
            $imgFile = $userForm->get('avatar')->getData();
            if ($imgFile && $imgFile != "") :
                // Rename File Imange
                $originalFilename = pathinfo($imgFile->getClientOriginalName(), PATHINFO_FILENAME);
                //  SluggerInterface $slugger
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imgFile->guessExtension();

                // Services: thiết lập biến mt
                try {
                    $imgFile->move(
                        $this->getParameter('image_dir'),
                        $newFilename
                    );
                } catch (FileException $th) {
                    echo $th;
                }
                $user->setAvatar($newFilename);
            endif;
            
            $repo->save($user, true);
            return $this->redirectToRoute('cus_profile', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render("customer/edit.html.twig", [
            'userForm' => $userForm->createView()
        ]);
    }
}
