<?php


namespace Polidog\BlogBundle\DomainEntityConverter;

use Polidog\Blog\Model\Account\Credential;
use Polidog\BlogBundle\Entity\User;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service(autowire=true)
 *
 * Class UserConverter
 * @package Polidog\BlogBundle\DomainEntityConverter
 */
class UserConverter
{

    /**
     * @param User $user
     * @return \Polidog\Blog\Model\Account\User
     */
    public function toDomain(User $user)
    {
        $credential = new Credential($user->getEmail(), $user->getPassword());
        return new \Polidog\Blog\Model\Account\User($user->getName(), $credential);
    }

    public function toDoctrine(\Polidog\Blog\Model\Account\User $user)
    {
        $entity = new User();
        $entity->setEmail($user->email())
            ->setName($user->name())
            ->setPassword($user->password())
            ->setAllowPosting(true);
        return $entity;
    }
}
