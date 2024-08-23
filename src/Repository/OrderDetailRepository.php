<?php

namespace App\Repository;

use App\Entity\Order;
use App\Entity\OrderDetail;
use App\Entity\Product;
use App\Entity\ProSize;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrderDetail>
 *
 * @method OrderDetail|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderDetail|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderDetail[]    findAll()
 * @method OrderDetail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderDetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderDetail::class);
    }

    public function save(OrderDetail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OrderDetail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function addProductToOrder(Order $order, ProSize $productSize, int $quantity): void
    {
        // $orderDetail = $this->findOrderDetailByOrderAndProduct($order, $productSize);

        // if ($orderDetail) {
        //     // Nếu OrderDetail đã tồn tại, cập nhật số lượng
        //     $orderDetail->setQuantity($orderDetail->getQuantity() + $quantity);
        //     $this->getEntityManager()->flush();
        //     return;
        // }

        // Nếu OrderDetail chưa tồn tại, tạo mới
        $orderDetail = new OrderDetail();
        $orderDetail->setOrders($order);
        $orderDetail->setProSize($productSize);
        $orderDetail->setQuantity($quantity);
        $this->getEntityManager()->persist($orderDetail);
    }


    /**
     * @return OrderDetail[] Returns an array of OrderDetail objects
     */
    public function findOrderDetail($value): array
    {
        //  SELECT od.id as id, p.name as product, s.name as size, od.quantity as quantity
        // FROM `order_detail` od 
        // JOIN `pro_size` ps ON od.pro_size_id = ps.id
        // JOIN `product` p ON p.id = ps.product_id
        // JOIN `size` s ON s.id = ps.size_id
        // WHERE od.orders_id = 93

        return $this->createQueryBuilder('od')
            ->select('od.id as id', 'o.id as orderId','p.name as product', 's.name as size', 'od.quantity as quantity', 'od.quantity * p.price as unitPrice')
            ->join('od.proSize', 'ps')
            ->join('ps.product', 'p')
            ->join('ps.size', 's')
            ->join('od.orders', 'o')
            ->andWhere('o.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getArrayResult();
    }

    //    /**
    //     * @return OrderDetail[] Returns an array of OrderDetail objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('o.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?OrderDetail
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
