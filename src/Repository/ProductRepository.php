<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Contracts\Cache\ItemInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    /**
     * @var CacheItemPoolInterface
     */
    private $cacheItemPool;

    public function __construct(ManagerRegistry $registry, CacheItemPoolInterface $cacheItemPool)
    {
        parent::__construct($registry, Product::class);
        $this->cacheItemPool = $cacheItemPool;
    }

    public function findOneBySlug(string $slug): ?Product
    {
        $safeSlug = str_replace(
            str_split(ItemInterface::RESERVED_CHARACTERS),
            '_',
            $slug
        );
        $cacheItem = $this->cacheItemPool->getItem("product_{$safeSlug}");

        if ($cacheItem->isHit()) {
            return $cacheItem->get();
        }

        $product = $this->findOneBy(['slug' => $slug]);
        if ($product === null) {
            return null;
        }

        $cacheItem->set($product);
        $cacheItem->expiresAfter(3600);
        $this->cacheItemPool->save($cacheItem);

        return $product;
    }
}
