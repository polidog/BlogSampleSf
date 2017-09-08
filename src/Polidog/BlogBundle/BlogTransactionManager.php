<?php


namespace Polidog\BlogBundle;


use Doctrine\ORM\EntityManager;
use Polidog\Blog\Application\TransactionManager;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service(autowire=true)
 *
 * Class BlogTransactionManager
 * @package Polidog\BlogBundle
 */
class BlogTransactionManager implements TransactionManager
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
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
