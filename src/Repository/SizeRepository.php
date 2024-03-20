<?php

namespace App\Repository;

use App\Entity\Size;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Size>
 *
 * @method Size|null find($id, $lockMode = null, $lockVersion = null)
 * @method Size|null findOneBy(array $criteria, array $orderBy = null)
 * @method Size[]    findAll()
 * @method Size[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SizeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Size::class);
    }

    public function save(Size $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Size $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Size[] Returns an array of Size objects
     */
    public function findSize($value): array
    {
        //SELECT * FROM `size` as s LEFT JOIN pro_size as ps ON s.id = ps.size_id
        return $this->createQueryBuilder('s')
            ->select('s.id as sizeId', 's.name as sizeName', 'ps.id as psId', 'ps.quantity as productQty', 'p.id as productId', 'p.name as productName')
            ->join('s.proSizes', 'ps')
            ->join('ps.product', 'p')
            ->andWhere('p.id = :val')
            ->setParameter('val', $value)
            ->groupBy('s.id')
            ->getQuery()
            ->getArrayResult();
    }

    //    /**
    //     * @return Size[] Returns an array of Size objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Size
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
