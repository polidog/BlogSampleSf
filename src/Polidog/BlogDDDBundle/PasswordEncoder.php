<?php


namespace Polidog\BlogDDDBundle;

use Polidog\Blog\Model\Account\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface as SymfonyPasswordEncoderInterface;

class PasswordEncoder implements PasswordEncoderInterface
{
    /**
     * @var SymfonyPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @param PasswordEncoderInterface $passwordEncoder
     */
    public function __construct(SymfonyPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * Encodes the raw password.
     *
     * @param string $raw  The password to encode
     * @param string $salt The salt
     *
     * @return string The encoded password
     */
    public function encodePassword(string $password, string $salt)
    {
        return $this->passwordEncoder->encodePassword($password, $salt);
    }

    /**
     * @param string $encoded An encoded password
     * @param string $raw     A raw password
     * @param string $salt    The salt
     *
     * @return bool true if the password is valid, false otherwise
     */
    public function isPasswordValid($encoded, $raw, $salt)
    {
        return $this->passwordEncoder->isPasswordValid($encoded, $raw, $salt);
    }


}
