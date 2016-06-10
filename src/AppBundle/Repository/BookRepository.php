<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Book;
use Doctrine\ORM\EntityRepository;

/**
 * Repository for Book entity.
 */
class BookRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function findAll()
    {
        return $this
            ->createQueryBuilder('b')
            ->orderBy('b.title')
            ->getQuery()
            ->execute()
        ;
    }

    /**
     * @param Book $book
     * @param bool $flush
     */
    public function add(Book $book, $flush = true)
    {
        $this->getEntityManager()->persist($book);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
