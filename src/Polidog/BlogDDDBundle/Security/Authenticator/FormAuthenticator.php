<?php


namespace Polidog\BlogDDDBundle\Security\Authenticator;


use Polidog\Blog\Application\UseCase\Authentication;
use Polidog\BlogDDDBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class FormAuthenticator extends AbstractFormLoginAuthenticator
{
    /**
     * @var Authentication
     */
    private $authentication;

    /**
     * @param Authentication $authentication
     */
    public function __construct(Authentication $authentication)
    {
        $this->authentication = $authentication;
    }

    protected function getLoginUrl()
    {
        return "/login/"; // TODO configへ
    }

    public function getCredentials(Request $request)
    {
        if ($request->getPathInfo() != '/login/' || false === $request->isMethod('POST')) {
            return;
        }

        $username = $request->request->get('_username');
        $request->getSession()->set(Security::LAST_USERNAME, $username);
        $password = $request->request->get('_password');

        return [
            'username' => $username,
            'password' => $password,
        ];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $username = $credentials['username'];
        return $userProvider->loadUserByUsername($username);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        if (false === $user instanceof User) {
            throw new AuthenticationException();
        }

        if (false === $this->authentication->run($credentials['username'], $credentials['password'])) {
            throw new AuthenticationException();
        }

        return true;
    }

    public function getDefaultSuccessRedirectUrl()
    {
        return "/mypage"; // TODO Using di container.
    }

}
