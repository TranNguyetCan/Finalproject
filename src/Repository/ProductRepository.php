<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function save(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    // public function findProduct(): array
    // {
    //     // SELECT * FROM `product` p 
    //     // JOIN `pro_size` ps ON p.id = ps.product_id
    //     // JOIN `size` s ON ps.size_id = s.id

    //     return $this->createQueryBuilder('p')
    //         ->select('p.id as proId', 'p.name as proName', 'p.image as proImage', 'p.price as proPrice', 's.name as sizeName')
    //         ->join('p.proSizes', 'ps')  
    //         ->join('ps.size', 's')
    //         ->getQuery()
    //         ->getArrayResult();
    // }

    /**
     * @return Product[] Returns an array of Product objects
     */
    public function findOnePro($value): array
    {

        return $this->createQueryBuilder('p')
            ->select('p.id', 'p.name', 'p.status', 'p.descriptions', 'p.image', 'p.price', 'c.name as category', 's.name as supplier', 'sz.name as sizeName', 'sz.id as sizeId')
            ->join('p.category', 'c')
            ->join('p.supplier', 's')
            ->join('p.proSizes', 'pz')
            ->join('pz.size', 'sz')
            ->Where('p.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getArrayResult();
    }
    /**
     * @return Product[] Returns an array of Product objects
     */
    public function findPro(): array
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @return Product[] Returns an array of Product objects
     */
    public function findAllSize(): array
    {
        return $this->createQueryBuilder('p')
            ->select('p.id as proId', 's.name as sizeName', 'pz.quantity as quantitySize')
            ->join('p.proSizes', 'pz')
            ->join('pz.size', 's')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @return Product[] Returns an array of Product objects
     */
    public function findBestSeller(): array
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(4)
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @return Product[] Returns an array of Product objects
     */
    public function findNewItem(): array
    {
        return $this->createQueryBuilder('p')
            ->join('p.proSizes', 'ps')
            ->andWhere('ps.quantity > :val')
            ->setParameter('val', 0)
            ->orderBy('p.id', 'DESC')
            ->groupBy('p.id')
            ->setMaxResults(4)
            ->getQuery()
            ->getArrayResult();
    }

    // Start sort by

    /**
     * @return Product[] Returns an array of Product objects
     */
    public function findByName($value): array
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.name', $value)
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @return Product[] Returns an array of Product objects
     */
    public function findByPrice($value): array
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.price', $value)
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @return Product[] Returns an array of Product objects
     */
    public function findByCate($value): array
    {
        return $this->createQueryBuilder('p')
            ->join('p.category', 'c')
            ->andWhere('c.name = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @return Product[] Returns an array of Product objects
     */
    public function findBySupp($value): array
    {
        return $this->createQueryBuilder('p')
            ->join('p.supplier', 's')
            ->andWhere('s.name = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @return Product[] Returns an array of Product objects
     */
    public function findBySize($value): array
    {
        return $this->createQueryBuilder('p')
            ->join('p.proSizes', 'ps')
            ->join('ps.size', 's')
            ->andWhere('s.name = :val')
            ->setParameter('val', $value)
            ->orderBy('ps.quantity', 'DESC')
            ->getQuery()
            ->getArrayResult();
    }
    /**
     * @return Product[] Returns an array of Product objects
     */
    public function findByGender($value): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.forGender = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @return Product[] Returns an array of Product objects
     */
    public function searchByName($value): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.name like :val')
            ->setParameter('val', '%' . $value . '%')
            ->getQuery()
            ->getArrayResult();
    }
    // End sort by

    /**
     * @return Product[] Returns an array of Product objects
     */
    public function findNameOfPro($value): array
    {
        return $this->createQueryBuilder('p')
            ->join('p.proSizes', 'ps')
            ->join('ps.size', 's')
            ->andWhere('s.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getArrayResult();
    }

    // /**
    //  * @return Product Returns an array of Product objects
    //  */
    // public function findNamePro($value): array
    // {
    //     return $this->createQueryBuilder('p')
    //     ->select('p.name as proName')
    //         ->orderBy('p.id', $value)
    //         ->getQuery()
    //         ->getArrayResult();
    // }


    //    /**
    //     * @return Product[] Returns an array of Product objects
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

    //    public function findOneBySomeField($value): ?Product
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
