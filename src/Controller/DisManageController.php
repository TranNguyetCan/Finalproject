<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Discount;
use App\Form\DiscountType;
use App\Repository\ProSizeRepository;

/**
 * @Route("/admin/discount")
 */
class DisManageController extends AbstractController
{
    /**
     * @Route("/create", name="create_discount")
     */
    public function createDiscountAction(Request $req, ManagerRegistry $reg, ProSizeRepository $repoProSize): Response
    {
        $d = new Discount();
        $discountForm = $this->createForm(DiscountType::class, $d);

        $discountForm->handleRequest($req);
        $entity = $reg->getManager();

        if ($discountForm->isSubmitted() && $discountForm->isValid()) {
            // $data = $discountForm->getData($req);
            // $proSize = $repoProSize->find($data->getProSize());
            // dd($proSize);
            // $d->setDeal($data->getDeal());
            // // $d->setProSize($data->getProSize());
            // $d->setStartDate($data->getStartDate());
            // $d->setProSize($proSize);
            // $d->setEndDate($data->getEndDate());
            // $d->setDescription($data->getDescription());

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $entity->persist($d);
            // actually executes the queries (i.e. the INSERT query)
            $entity->flush();
        }
        return $this->render('discount_manage/new.html.twig', [
            'form' => $discountForm->createView()
        ]);
    }
}
