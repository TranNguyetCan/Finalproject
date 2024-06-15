<?php

namespace App\Controller;

use App\Repository\VoucherRepository;
use App\Repository\ProductRepository;
use App\Repository\ProSizeRepository;
use App\Repository\SizeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Voucher;
use App\Entity\Product;
use App\Form\VoucherType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Persistence\ManagerRegistry;
/**
 * @Route("/voucher")
 */
class VoucherController extends AbstractController
{
    //repository
    private VoucherRepository $repo;
    public function __construct(VoucherRepository $repo)
    {
        $this->repo = $repo;
    }
    /**
     * @Route("/", name="index")
     */
    public function index(ProductRepository $productRepository, ProSizeRepository $proSizeRepository): Response
    {
        try {
            $products = $productRepository->findAll();
            $proSize = $proSizeRepository->findNameSize([], [
                        'id' => 'DESC'
                    ]);
        } catch (\Exception $e) {
            throw new \Exception('Error fetching products or vendor images: ' . $e->getMessage());
        }

        return $this->render('voucher/index.html.twig', [
            'products' => $products,
            'proSize' => $proSize
            
            
        ]);
    }


    /**
     * @Route("/Voucher/share/{id}", name="shareVoucher")
     */
    public function shareProduct($id, VoucherRepository $VoucherRepository): Response
    {
        $product = $VoucherRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Product not found.');
        }

        return $this->render('Voucher/index.html.twig', [
            'product' => $product,
        ]);
    }
      /**
     * @Route("/detail/{id}", name="product_detail")
     */
    public function productDetailAction(Product $p, ProSizeRepository $repoPs): Response
    {
        $proSize = $repoPs->findNameSize([], [
            'id' => 'DESC'
        ]);

        return $this->render('product/detail.html.twig', [
            'product' => $p,
            'proSize' => $proSize
        ]);
    }

}
