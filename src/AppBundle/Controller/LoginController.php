<?php


namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/login")
 *
 * Class LoginController
 * @package AppBundle\Controller
 */
class LoginController extends Controller
{
    /**
     * @Route("/")
     * @Method("GET")
     * @Template(":login:login.html.twig")
     */
    public function indexAction()
    {
        $helper = $this->get('security.authentication_utils');

        return [
            'last_username' => $helper->getLastUsername(),
            // last authentication error (if any)
            'error' => $helper->getLastAuthenticationError(),
        ];
    }

    /**
     * @Route("/")
     * @Method("POST")
     */
    public function loginAction()
    {

    }
}
