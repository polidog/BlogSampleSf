<?php


namespace Polidog\BlogBundle\DomainEntityConverter;


use Polidog\Blog\Model\Post\Author;
use Polidog\BlogBundle\Entity\User;
use Polidog\BlogBundle\Repository\UserRepository;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service(autowire=true)
 *
 * Class AuthorConverter
 * @package Polidog\BlogBundle\DomainEntityConverter
 */
class AuthorConverter
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function toDomain(User $user)
    {
        return new Author($user->getId(), $user->getName(), $user->getAllowPosting());
    }

}
