<?php


namespace AppBundle\Controller\Mypage\Blog;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/mypage/blog/{id}/publish", requirements={"id":"\d+"})
 *
 * Class PublishController
 * @package AppBundle\Controller\Mypage\Blog
 */
class PublishController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction($id)
    {
        $this->get('polidog_blog_ddd.publish_post')->run($id, $this->getUser()->getId());
        return $this->redirectToRoute('app_mypage_default_index');
    }
}
