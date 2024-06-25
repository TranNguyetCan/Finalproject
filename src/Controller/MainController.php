<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\ProSizeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private ProductRepository $repo;
    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @Route("/", name="home_page")
     */
    public function homeAction(ProSizeRepository $repoPs): Response
    {
        $bestseller = $this->repo->findBestSeller();

        $newItems = $this->repo->findNewItem();
        $proSizes = $repoPs->findNameSize([], [
            'id' => 'DESC'
        ]);

        return $this->render(
            'main/index.html.twig',
            [
                'newItems' => $newItems,
                'bestseller' => $bestseller,
                'proSizes' => $proSizes
            ]
        );
    }

    /**
     * @Route("/danaischgStore", name="aboutUs")
     */
    public function aboutUsAction(): Response
    {
        return $this->render('about/index.html.twig');
    }

    /**
     * @Route("/branch", name="branches")
     */
    public function index(): Response
    {
        // Sample data for branches, replace this with data from your database
        $branches = [
            'Branch 1',
            'Branch 2',
            'Branch 3',
            'Branch 4',
            'Branch 5',
            'Branch 6'
        ];

        return $this->render('base.html.twig', [
            'branches' => $branches
        ]);
    }
}
