<?php

namespace App\Controller;

use App\Entity\Branch;
use App\Repository\BranchRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\HttpFoundation\JsonResponse; 
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;

class BranchController extends AbstractController
{
    private BranchRepository $repo;
    public function __construct(BranchRepository $repo)
    {
        $this->repo = $repo;
    }

    #[Route('/branch', name: 'app_branch')]
    public function index(): Response
    {
        return $this->render('branch/index.html.twig', [
            'controller_name' => 'BranchController',
        ]);
    }

    // API to get all branches in database with method GET
    #[Route('/api/branch', name: 'api_branch', methods: ['GET'])]
    public function getBranches(): JsonResponse
    {
        $branches = $this->repo->findAll();
        $data = [];
        foreach ($branches as $branch) {
            $data[] = [
                'id' => $branch->getId(),
                'name' => $branch->getBranchName(),
                'address' => $branch->getBranchAddress(),
            ];
        }

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }
}
