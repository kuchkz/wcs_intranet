<?php

/**
 * Abstract Controller file
 *
 * PHP Version 7.2
 *
 * @category Controller
 * @package  Abstract
 * @author   Julie Delmas <julie.delmas33@gmail.com>
 * @author   Florian Radureau <fradureau@gmail.com>
 * @author   Christophe Kuchmac <kuchkz@gmail.com>
 * @author   Sami Aid <samiaid2@gmail.com>
 */

namespace Controller;

use Twig_Loader_Filesystem;
use Twig_Environment;
use Twig_Extensions;

use App\Connection;

/**
 * Abstract class controller.
 *
 * @category Controller
 * @package  Abstract
 */
abstract class AbstractController
{
    /**
     * Twig environment
     *
     * @var Twig_Environment
     */
    protected $twig;

    /**
     * PDO object allowing to request on DB
     *
     * @var \PDO
     */
    protected $pdo;

    /**
     *  Initializes this class
     */
    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem(APP_VIEW_PATH);
        $this->twig = new Twig_Environment(
            $loader,
            [
                'cache' => !APP_DEV,
                'debug' => APP_DEV,
            ]
        );
        $this->twig->addExtension(new \Twig_Extension_Debug());
        $this->twig->addExtension(new \Twig_Extensions_Extension_Text());
        session_start();
        $this->twig->addGlobal('session', $_SESSION);
        $this->twig->addGlobal('_get', $_GET);
        $connection = new Connection();
        $this->pdo = $connection->getPdoConnection();
    }

    /**
     * Allowing to get PDO outside abstractController
     *
     * @return \PDO
     */
    public function getPdo(): \PDO
    {
        return $this->pdo;
    }

    /**
     * @param string $data
     * @return string
     */
    public function test_input(string $data) {
        $data = trim($data);
        $data = stripslashes($data);
        return $data;
    }
    /**
     * @param string $email
     * @return string
     */
    public function isEmail(string $email) : string {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param string $phone
     * @return string
     */
    public function isPhone(string $phone) : string {
        return preg_match("^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$^", $phone);
    }

    /**
     * @param string $linkedin
     * @return string
     */
    public function isLinkedin(string $linkedin): string{
        return preg_match("^https:\\/\\/[a-z]{2,3}\\.linkedin\\.com\\/.*$^", $linkedin);
    }

    /**
     * @param string $odyssey
     * @return string
     */
    public function isOdyssey(string $odyssey): string{
        return preg_match("^https:\\/\\/odyssey\\.wildcodeschool\\.fr\\/users\\/.*$^", $odyssey);
    }

    /**
     * @param string $phone
     * @return string
     */
    public function isGitHub(string $gitHub): string{
        return preg_match("^https:\\/\\/github\\.com\\/.*$^", $gitHub);
    }
}