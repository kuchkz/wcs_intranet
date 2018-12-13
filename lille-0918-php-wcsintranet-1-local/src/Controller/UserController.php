<?php

/**
 * UserController file
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

use Model\Promo\PromoManager;
use Model\User\User;
use Model\User\UserManager;
use Model\Article\Article;
use Model\Article\ArticleManager;
use Model\Comment\Comment;
use Model\Comment\CommentManager;
use Model\Language\LanguageManager;
use Model\Language\Language;

/**
 * User class controller.
 *
 * @category Controller
 * @package  Controller
 */
class UserController extends AbstractController
{
    /**
     * Login's page.
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return string The rendered template
     */
    public function home()
    {
        if (!$_SESSION['user'])
            header('Location:/');
        else {
            $articleManager = new ArticleManager($this->getPdo());
            $articles = $articleManager->LastArticles();

            $rss = simplexml_load_file('https://feeds.feedburner.com/TheHackersNews');
            $rss_split = [];
            foreach ($rss->channel->item as $item) {
                $title = (string)$item->title; // Title
                $link = (string)$item->link; // Url Link
                $description = (string)$item->description; //Description
                $rss_split[] = [
                    'link' => $link,
                    'title' => $title,
                    'description' => $description
                ];
            }
            return $this->twig->render('User/home.html.twig', [
                'articles' => $articles,
                'news' => $rss_split,
                'current' => 1
            ]);
        }
    }

    /**
     * User's profile page
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return string The rendered template
     */
    public function profile(): string
    {
        if (!$_SESSION['user'])
            header('Location:/');
        else
            return $this->twig->render('User/profile.html.twig', ['current' => 2]);

    }

    /**
     * User's edit page
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return string The rendered template
     */
    public function editProfile()
    {
        if (!$_SESSION['user'])
            header('Location:/');
        else {
            $error = [];
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $phoneNumber = $this->test_input($_POST['phoneNumber']);
                $gitHub = $this->test_input($_POST['gitHub']);
                $linkedin = $this->test_input($_POST['linkedin']);
                $odyssey = $this->test_input($_POST['odyssey']);

                if (empty($_POST['birthDate']) || !isset($_POST['birthDate']))
                    $error['birthDate'] = "Ce champ ne peut pas être vide.";
                if (empty($gitHub) || !isset($gitHub))
                    $error['gitHub'] = "Ce champ ne peut pas être vide.";
                elseif (!$this->isGitHub($gitHub))
                    $error['gitHub'] = "L'adresse doit être celle de votre profil GitHub.";
                if (!$this->isLinkedin($linkedin))
                    $error['linkedin'] = "L'adresse doit être celle de votre profil Linkedin.";
                if (!$this->isOdyssey($odyssey))
                    $error['odyssey'] = "L'adresse doit être celle de votre profil Odyssey.";

                if (count($error) === 0) {
                    $user = new User();
                    $userManager = new UserManager($this->getPdo());
                    $user->setId($_SESSION['user']->getId());
                    $user->setGitHub($gitHub);
                    $userManager->updateBirthDate($_SESSION['user']->getId(), $_POST['birthDate']);
                    $_SESSION['user']->setBirthDate($_POST['birthDate']);
                    if (empty($phoneNumber) || !isset($phoneNumber) || !$this->isPhone($phoneNumber))
                        $user->setPhoneNumber(" ");
                    else
                        $user->setPhoneNumber($phoneNumber);
                    if (empty($linkedin) || !isset($linkedin))
                        $user->setLinkedin(" ");
                    else
                        $user->setLinkedin($linkedin);
                    if (empty($odyssey) || !isset($odyssey))
                        $user->setOdyssey(" ");
                    else
                        $user->setOdyssey($odyssey);
                    $userManager->update($user);
                    $_SESSION['user'] = $userManager->selectOneByEmail($_SESSION['user']->getEmail());
                    header("Location: /profile");
                }
            }
            return $this->twig->render(
                'User/edit.html.twig', [
                    'grade' => 0,
                    'errors' => $error,
                    'current' => 2
                ]
            );
        }
    }

    /**
     * Password'initiation page.
     *
     * @return string the rendered template
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function initPassword(){

        if (isset($_GET['code'])){
            $userManager = new UserManager($this->getPdo());
            $userArray = $userManager->selectOneByCode($_GET['code']);
            if (!$userManager->selectOneByCode($_GET['code']) && empty($_POST))
                header('Location:/');
            return $this->twig->render('User/password.html.twig', ['user' => $userArray]);
        }
        elseif (isset($_POST)){
            $error = [];
            if (strlen($_POST['password']) < 8 || $_POST['password'] != $_POST['passwordConfirm'])
                $error['password'] = "Il y a eu un problème avec votre mot de passe. Veuillez réessayer.";
            $userManager = new UserManager($this->getPdo());
            $userArray = $userManager->selectOneById($_POST['id']);
            if (count($error) === 0){
                $user = new User();
                $user->setId($_POST['id']);
                $user->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT));
                $userManager->init($user);
                $userManager->codeDelete($user->getId());
                header('Location:/disconnect');
            }
            else
                return $this->twig->render('User/password.html.twig', ['user' => $userArray], ['errors' => $error]);
        }
        else
            header('Location:/');
    }

    /**
     * Trombinoscope's page.
     *
     * @return string the rendered template
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function showTrombinoscope()
    {
        if (!$_SESSION['user'])
            header('Location:/');
        else {
            $lm = new LanguageManager($this->getPdo());
            $languages = $lm->selectAll();
            $pm = new PromoManager($this->getPdo());
            $promos = $pm->selectAll();
            $userManager = new UserManager($this->getPdo());
            $users = $userManager->selectAllUsers();
            if(isset($_POST['selectPromo']) && !empty($_POST['selectPromo']) && isset($_POST['selectLanguage'])
                && !empty($_POST['selectLanguage'])){
                $promoSelected = $_POST['selectPromo'];
                $languageSelected = $_POST['selectLanguage'];
                return $this->twig->render('User/trombinoscope.html.twig', ['users' => $users,
                    'current' => 4, 'promos' => $promos, 'languages' => $languages, 'languageSelected' => $languageSelected,
                    'promoSelected' => $promoSelected]);
            }

            return $this->twig->render('User/trombinoscope.html.twig', ['users' => $users, 'current' => 4,
                'promos' => $promos, 'languages' => $languages]);
        }
    }

    /**
     * Other users' page.
     *
     * @param int $id selecting user
     * @return string the rendered template
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function showProfile(int $id)
    {
        if (!$_SESSION['user'])
            header('Location:/');
        {
            if ($id == $_SESSION['user']->getId())
                header('Location:/profile');
            else {
                $userManager = new UserManager($this->getPdo());
                $user = $userManager->selectOneById($id);
                return $this->twig->render('User/showProfile.html.twig', ['user' => $user, 'current' => 4]);
            }
        }
    }

    /**
     * legal Notice
     * @return string the rendered template
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function showCgu()
    {
        return $this->twig->render('User/mentions-legales.html.twig');
    }
}

