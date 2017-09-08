<?php


namespace Polidog\BlogBundle\Criteria;

use PHPMentors\DomainKata\Entity\CriteriaInterface;
use Polidog\Blog\Model\Post\PostCriteria as BaseCriteria;
use Polidog\BlogBundle\Criteria;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service()
 *
 * Class PostCriteria
 * @package Polidog\BlogBundle\Criteria
 */
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

        if (!empty($this->search)) {
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
