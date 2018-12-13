<?php

/**
 * StaffController file
 *
 * PHP Version 7.2
 *
 * @category Controller
 * @package  Controller
 * @author   Julie Delmas <julie.delmas33@gmail.com>
 * @author   Florian Radureau <fradureau@gmail.com>
 * @author   Christophe Kuchmac <kuchkz@gmail.com>
 * @author   Sami Aid <samiaid2@gmail.com>
 */
namespace Controller;

use Model\User\UserManager;

/**
 * Class security controller.
 *
 * @category Controller
 * @package  Controller
 */
class SecurityController extends AbstractController
{
    /**
     * Displaying home page
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return string The rendered template
     */
    public function index()
    {
        if (isset($_SESSION['user']))
            header('Location:/home');
        else {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $givenLogin = htmlentities($_POST['email']);
                $givenPassword = htmlentities($_POST['password']);
                $em = new UserManager($this->getPdo());
                $user = $em->selectOneByEmail($givenLogin);
                if ($user === null || !password_verify($givenPassword, $user->getPassword())) {
                    $loginError = "Problème d'identifiant et/ou mot de passe.";
                    return $this->twig->render('index.html.twig', ['error' => $loginError]);
                } else {
                    $_SESSION['user'] = $user;
                    header('Location:/home');
                }
            }
            return $this->twig->render('index.html.twig');
        }
    }

    /**
     * disconnect
     */
    public function disconnect(){
        session_start();
        session_destroy();
        header('Location:/');
    }
}