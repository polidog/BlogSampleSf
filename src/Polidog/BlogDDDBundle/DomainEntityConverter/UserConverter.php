<?php


namespace Polidog\BlogDDDBundle\DomainEntityConverter;

use Polidog\Blog\Model\Account\Credential;
use Polidog\BlogDDDBundle\Entity\User;
use vendor\polidog\blogddd\src\Model\Password;

class UserConverter
{
    /**
     * @param User $author
     * @return \Polidog\Blog\Model\Post\Author
     */
    public function toAuthor(User $author)
    {
        // TODO author converterへ
        return new \Polidog\Blog\Model\Post\Author($author->getId(), $author->getName(), $author->getAllowPosting());
    }

    /**
     * @param User $user
     * @return \Polidog\Blog\Model\Account\User
     */
    public function toUser(User $user)
    {
        $credential = new Credential($user->getEmail(), $user->getPassword(), $user->getSalt());
        return new \Polidog\Blog\Model\Account\User($user->getName(), $credential);
    }

    public function formUser(\Polidog\Blog\Model\Account\User $user)
    {
        $entity = new User();
        $entity->setEmail($user->email())
            ->setName($user->name())
            ->setPassword($user->password())
            ->setSalt($user->salt())
            ->setAllowPosting(true);
        return $entity;
    }
}
