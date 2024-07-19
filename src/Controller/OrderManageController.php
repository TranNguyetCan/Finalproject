<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\OrderRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin/order")
 */
class OrderManageController extends AbstractController
{
    private OrderRepository $repo;
    public function __construct(OrderRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @Route("/", name="order_page")
     */
    public function orderAction(): Response
    {
        $orders = $this->repo->findBy([], [
            'id' => 'DESC'
        ]);

        return $this->render('order_manage/index.html.twig', [
            'orders' => $orders
        ]);
    }
    /**
     * @Route("/add", name="order_create")
     */
    public function createAction(Request $req, OrderRepository $repo): Response
    {

        $o = new Order();
        $formOr = $this->createForm(OrderType::class, $o);

        $formOr->handleRequest($req);
        if ($formOr->isSubmitted() && $formOr->isValid()) {


            $repo->save($o, true);
            return $this->redirectToRoute('order_page', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("order_manage/add.html.twig", [
            'formOr' => $formOr->createView()
        ]);
    }

    /**
     * @Route("/changeConfirm/{id}", name="change_page")
     */
    public function changeAction(int $id, ManagerRegistry $reg): Response
    {
        $orders = $this->repo->find($id);
        $orders->setStatus(1);
        $entity = $reg->getManager();

        $entity->persist($orders);
        $entity->flush();

        return $this->redirectToRoute('order_page');
    }
}
