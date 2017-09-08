<?php


namespace Polidog\BlogBundle\DomainEntityConverter;


use Polidog\Blog\Model\Post\Article;
use Polidog\Blog\Model\Post\PostStatus;
use Polidog\BlogBundle\Entity\Post;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service(autowire=true)
 *
 * Class PostConverter
 * @package Polidog\BlogBundle\DomainEntityConverter
 */
class PostConverter
{
    /**
     * @var AuthorConverter
     */
    private $authorConverter;

    /**
     * @param AuthorConverter $authorConverter
     */
    public function __construct(AuthorConverter $authorConverter)
    {
        $this->authorConverter = $authorConverter;
    }


    /**
     * @param Post $entity
     * @return \Polidog\Blog\Model\Post\Post
     */
    public function toDomain(Post $entity)
    {
        $author = $this->authorConverter->toDomain($entity->getAuthor());
        $postStatus = new PostStatus($entity->getStatus());
        $post = new \Polidog\Blog\Model\Post\Post($author, $postStatus);
        $post->update(new Article($entity->getTitle(), $entity->getContent(), $entity->getDisplayDate()));
        $post->setPostId($entity->getId());
        return $post;

    }

}
