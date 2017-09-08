<?php

namespace AppBundle\Controller;

use Polidog\Blog\Model\Post\PostStatus;
use Polidog\BlogBundle\Criteria\PostCriteria;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template("default/index.html.twig")
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
        $criteria->setSearch($request->get("s",""));
        $criteria->setStatus(PostStatus::PUBLISHED); // TODO この実装はいいのか？お漏らししている漢字あるのでいい感じにする
        $posts = $this->get('polidog_blog.list_posts')->run($offset, $limit, $criteria);
        return [
            'posts' => $posts,
            'page' => $page,
        ];
    }

    /**
     * @Route("/{year}/{month}/{id}", requirements={"id":"\d+","year":"\d{4}", "month":"\d{2}"})
     * @Template("default/detail.html.twig")
     *
     * @param $id
     * @return array
     */
    public function detailAction($id)
    {
        $post = $this->get('polidog_blog.show_post')->run($id);
        return [
            'post' => $post,
        ];
    }

}
