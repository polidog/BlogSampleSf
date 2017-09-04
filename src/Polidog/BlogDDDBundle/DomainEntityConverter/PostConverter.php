<?php


namespace Polidog\BlogDDDBundle\DomainEntityConverter;


use Polidog\Blog\Model\Post\PostStatus;
use Polidog\BlogDDDBundle\Entity\Post;


class PostConverter
{
    /**
     * @param Post $entity
     * @return \Polidog\Blog\Model\Post\Post
     */
    public function toPost(Post $entity)
    {
        $postStatus = PostStatus::newDraft();
        if ($entity->getStatus() === PostStatus::PUBLISHED) {
            $postStatus->publish();
        }

        $post = new \Polidog\Blog\Model\Post\Post(
            $entity->getTitle(),
            $entity->getContent(),
            $entity->getDisplayDate(),
            (new UserConverter())->toAuthor($entity->getAuthor()),
            $postStatus
        );
        $post->setPostId($entity->getId());
        return $post;
    }

}
