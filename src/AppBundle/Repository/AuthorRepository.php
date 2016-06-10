<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Author;
use Doctrine\ORM\EntityRepository;

/**
 * Repository for Author entity.
 */
class AuthorRepository extends EntityRepository
{
    /**
     * @param string $name
     *
     * @return array
     */
    public function findLike($name)
    {
        return $this
            ->createQueryBuilder('a')
            ->where('a.name LIKE :name')
            ->setParameter('name', "%$name%")
            ->orderBy('a.name')
            ->setMaxResults(10)
            ->getQuery()
            ->execute()
        ;
    }

    /**
     * @param Author $author
     * @param bool   $flush
     */
    public function add(Author $author, $flush = true)
    {
        $this->getEntityManager()->persist($author);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
