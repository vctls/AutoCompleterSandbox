<?php

namespace AppBundle\Repository;


use AppBundle\Entity\Tag;
use Doctrine\ORM\EntityRepository;

class TagRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function findAll()
    {
        return $this
            ->createQueryBuilder('t')
            ->orderBy('t.name')
            ->getQuery()
            ->execute();
    }

    /**
     * @param string $name
     *
     * @return array
     */
    public function findLike($name)
    {
        return $this
            ->createQueryBuilder('t')
            ->where('t.name LIKE :name')
            ->setParameter('name', "%$name%")
            ->orderBy('t.name')
            ->setMaxResults(10)
            ->getQuery()
            ->execute();
    }

    /**
     * @param Tag $tag
     * @param bool $flush
     */
    public function add(Tag $tag, $flush = true)
    {
        $this->getEntityManager()->persist($tag);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}