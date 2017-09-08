<?php


namespace Polidog\BlogBundle\Repository;


use Doctrine\ORM\EntityManager;
use Polidog\BlogBundle\DomainEntityConverter\AuthorConverter;
use Polidog\BlogBundle\Entity\User;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service(autowire=true)
 *
 * Class AuthorRepository
 * @package Polidog\BlogBundle\Repository
 */
class AuthorRepository implements \Polidog\Blog\Model\Post\AuthorRepository
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var AuthorConverter
     */
    private $authorConverter;

    /**
     * @param EntityManager   $entityManager
     * @param AuthorConverter $authorConverter
     */
    public function __construct(EntityManager $entityManager, AuthorConverter $authorConverter)
    {
        $this->entityManager = $entityManager;
        $this->authorConverter = $authorConverter;
    }

    public function get(int $id)
    {
        $user = $this->find($id);
        if ($user instanceof User) {
            return $this->authorConverter->toDomain($user);
        }
    }

    private function find($id, $lockMode = null, $lockVersion = null)
    {
        return $this->entityManager->find(User::class, $id, $lockMode, $lockVersion);
    }

}
