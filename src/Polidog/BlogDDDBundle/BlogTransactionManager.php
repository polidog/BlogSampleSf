<?php


namespace Polidog\BlogDDDBundle;


use Doctrine\ORM\EntityManagerInterface;
use Polidog\Blog\Application\TransactionManager;

class BlogTransactionManager implements TransactionManager
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function begin()
    {
        $this->entityManager->beginTransaction();
    }

    public function commit()
    {
        $this->entityManager->commit();
    }

    public function rollback()
    {
        $this->entityManager->rollback();
    }


}
