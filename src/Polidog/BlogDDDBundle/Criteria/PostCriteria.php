<?php


namespace Polidog\BlogDDDBundle\Criteria;

use PHPMentors\DomainKata\Entity\CriteriaInterface;
use Polidog\Blog\Model\Post\PostCriteria as BaseCriteria;
use Polidog\BlogDDDBundle\Criteria;

class PostCriteria extends BaseCriteria
{
    /**
     * {@inheritdoc}
     */
    public function build()
    {
        $criteria = new Criteria();

        if (null !== $this->status) {
            $criteria->andWhere(
                $criteria->expr()->eq('status', $this->status)
            );
        }

        if (null !== $this->search) {
            $criteria->andWhere(
                $criteria->expr()->orX(
                    $criteria->expr()->eq('title', $this->search),
                    $criteria->expr()->eq('content', $this->search)
                )
            );
        }

        return $criteria;
    }

}
