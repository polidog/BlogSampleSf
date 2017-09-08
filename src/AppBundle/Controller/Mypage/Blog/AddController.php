<?php


namespace AppBundle\Controller\Mypage\Blog;


use AppBundle\Form\Type\PostType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/mypage/blog/add")
 *
 * Class AddController
 * @package AppBundle\Controller\Mypage\Blog
 */
class AddController extends Controller
{
    const FORM_TYPE = PostType::class;

    /**
     * @Route("/")
     * @Method("GET")
     * @Template(":mypage/blog:add.html.twig")
     */
    public function indexAction()
    {
        $form = $this->createForm(self::FORM_TYPE);

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/")
     * @Method("POST")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function saveAction(Request $request)
    {
        $form = $this->createForm(self::FORM_TYPE);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
            $this->get('polidog_blog.use_case.add_post')->run($this->getUser()->getId(), $data['displayDate'], $data['title'], $data['content']);
        } else {
            // TODO エラーアラート
            return $this->redirectToRoute("app_mypage_blog_add_index");
        }

        // TODO OKアラート
        return $this->redirectToRoute('app_mypage_default_index');
    }

}
