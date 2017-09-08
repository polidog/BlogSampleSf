<?php


namespace AppBundle\Controller\Mypage;


use Polidog\Blog\Model\Post\PostStatus;
use Polidog\BlogBundle\Criteria\PostCriteria;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/mypage")
 * Class DefaultController
 * @package AppBundle\Controller\Mypage
 */
class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template(":mypage/default:index.html.twig")
     */
    public function indexAction(Request $request)
    {
        $limit = 30;
        $page = (int)$request->get('page');
        if ($page < 1) {
            $page = 1;
        }

        $offset = ($page - 1) * $limit;

        $criteria = new PostCriteria();
        $posts = $this->get('polidog_blog.list_posts')->run($offset, $limit, $criteria);

        return [
            'posts' => $posts,
            'page' => $page,
        ];
    }
}
