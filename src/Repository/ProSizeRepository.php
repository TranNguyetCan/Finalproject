<?php

namespace App\Repository;

use App\Entity\ProSize;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProSize>
 *
 * @method ProSize|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProSize|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProSize[]    findAll()
 * @method ProSize[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProSizeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProSize::class);
    }

    public function save(ProSize $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProSize $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    /**
     * @return ProSize[] Returns an array of ProSize objects
     */
    public function findByProduct($pro, $size): array
    {
        return $this->createQueryBuilder('ps')
            ->select('s.name as sizeName', 'p.id as proId', 'p.name as proName', 'ps.quantity as quantity')
            ->join('ps.product', 'p')
            ->join('ps.size', 's')
            ->andWhere('p.id = :val')
            ->setParameter('val', $pro)
            ->andWhere('p.id = :val')
            ->setParameter('val', $size)
            ->getQuery()
            ->getArrayResult();
    }
    /**
     * @return ProSize[] Returns an array of Cart objects
     */
    public function findProSizeById($proId, $sizeId): array
    {
        //SELECT * FROM `size` as s JOIN `pro_size` as ps ON s.id = ps.size_id WHERE ps.product_id = 1 AND s.id = 2

        return $this->createQueryBuilder('ps')
            // ->innerJoin('ps.size', 's')
            ->andWhere('ps.size = :val')
            ->setParameter('val', $sizeId)
            ->andWhere('ps.product = :i')
            ->setParameter('i', $proId)
            ->getQuery()
            ->getArrayResult();
    }
    
    /**
     * @return ProSize[] Returns an array of ProSize objects
     */
    public function findNameSize(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT s.id as sizeId, s.name as sizeName, ps.quantity as productQty, ps.product_id as proId, 
        ps.id as psId FROM size as s INNER JOIN pro_size as ps ON ps.size_id = s.id GROUP BY ps.id ORDER BY s.id ASC';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    /**
     * @return ProSize[] Returns an array of ProSize objects
     */
    public function findSize($value): array
    {
        return $this->createQueryBuilder('ps')
            ->select('s.id as sizeId', 's.name as sizeName', 'ps.quantity as productQty', 'ps.id as proSizeId')
            ->join('ps.size', 's')
            ->join('ps.product', 'p')
            ->andWhere('p.id = :val')
            ->setParameter('val', $value)
            ->groupBy('s.id')
            ->getQuery()
            ->getArrayResult();
    }


    /**
     * @return ProSize[] Returns an array of ProSize objects
     */
    public function findAlreadySize($proId, $sizeId): array
    {
        return $this->createQueryBuilder('ps')
            ->select('ps.id as proSizeId')
            ->andWhere('ps.product = :p')
            ->setParameter('p', $proId)
            ->andWhere('ps.size = :s')
            ->setParameter('s', $sizeId)
            ->getQuery()
            ->getArrayResult();
    }
    //    /**
    //     * @return ProSize[] Returns an array of ProSize objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ProSize
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
