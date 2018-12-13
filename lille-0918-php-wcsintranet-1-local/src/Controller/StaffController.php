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

use Model\Language\Language;
use Model\Language\LanguageManager;
use Model\Promo\PromoManager;
use Model\Promo\Promo;
use Model\User\User;
use Model\User\UserManager;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;

/**
 * Staff class controller.
 *
 * @category Controller
 * @package  Controller
 */
class StaffController extends AbstractController
{
    /**
     * Admin panel for users management.
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return string The rendered template
     */
    public function user()
    {
        if (!isset($_SESSION['user']))
            header('Location:/');
        elseif ($_SESSION['user']->getisAdmin() != 1)
            header('Location:/home');
        else {
            $userManager = new UserManager($this->getPdo());
            $pm = new PromoManager($this->getPdo());
            $lm = new LanguageManager($this->getPdo());
            if (isset($_POST['addPromo'])){
                $promo = new Promo;
                $promo->setName($_POST['addPromo']);
                $pm->add($promo);
            }
            if (isset($_POST['addUserToPromo'])){
                foreach($_POST['addUserToPromo'] as $value){
                    $userManager->addUserToPromo($value, $_POST['promoId']);
                }
            }
            if(isset($_POST['deleteUserFromPromo'])){
                foreach($_POST['deleteUserFromPromo'] as $value){
                    $userManager->removeUserPromo($value);
                }
            }
            if(isset($_POST['deletePromo'])){
                $pm->delete($_POST['deletePromo']);
            }
            $promos = $pm->selectAll();
            if(isset($_POST['addLanguage'])){
                $language = new Language();
                $language->setNameLanguage($_POST['addLanguage']);
                $lm->add($language);
            }
            if(isset($_POST['addUserToLanguage'])){
                foreach($_POST['addUserToLanguage'] as $value){
                    $userManager->addUserToLanguage($value, $_POST['languageId']);
                }
            }
            if(isset($_POST['deleteUserFromLanguage'])){
                foreach($_POST['deleteUserFromLanguage'] as $value){
                    $userManager->removeUserLanguage($value);
                }
            }
            if(isset($_POST['deleteLanguage'])){
                $lm->delete($_POST['deleteLanguage']);
            }
            $languages = $lm->selectAll();
            if (isset($_POST['1'])) {
                $users = $_POST;
                foreach ($users as $value) {
                    $user = new User();
                    $user->setFirstName($value['firstname']);
                    $user->setLastName($value['lastname']);
                    $user->setEmail($value['email']);
                    $user->setCode(password_hash(mt_rand(), PASSWORD_BCRYPT));
                    if (isset($value['isAdmin']))
                        $user->setisAdmin($value['isAdmin']);
                    else
                        $user->setisAdmin(0);
                    $userManager->add($user);
                    $this->sendMail($user);
                }
            }
            $users = $userManager->selectAllUsers();
            if(isset($_POST['deleteUserInPromo'])){
                $promoSelected = $_POST['deleteUserInPromo'];
                return $this->twig->render('Staff/user.html.twig', ['users' => $users, 'current' => 5,
                    'promos' => $promos, 'languages' => $languages, 'promoSelected' => $promoSelected]);
            }
            if(isset($_POST['deleteUserInLanguage'])){
                $languageSelected = $_POST['deleteUserInLanguage'];
                return $this->twig->render('Staff/user.html.twig', ['users' => $users, 'current' => 5,
                    'languages' => $languages, 'promos' => $promos, 'languageSelected' => $languageSelected]);
            }
            return $this->twig->render(
                'Staff/user.html.twig',
                ['users' => $users, 'current' => 5,
                    'promos' => $promos, 'languages' => $languages]);
        }
    }

    /**
     * Staff's form for modifying student
     *
     * @param int $id to modify
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return string The rendered template
     */
    public function userModify($id)
    {
        if (!isset($_SESSION['user']))
            header('Location:/');
        elseif ($_SESSION['user']->getisAdmin() != 1)
            header('Location:/home');
        else{
            $error = [];
            $userManager = new UserManager($this->getPdo());
            $userArray = $userManager->selectOneById($id);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $user = new User();
                if (!empty($_FILES['fichier']['name'])) {
                    $uploadDir = 'assets/images/';
                    $extension = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);
                    $filename = $id . '.' . $extension;
                    $uploadFile = $uploadDir . basename($filename);
                    move_uploaded_file($_FILES['fichier']['tmp_name'], $uploadFile);
                    $userManager = new UserManager($this->getPdo());
                    $uploadFile = "/" . $uploadFile;
                    $upload = $userManager->changePhoto($id, $uploadFile);
                }
                if (isset($_POST['phoneNumber'])) {
                    $phoneNumber = $this->test_input($_POST['phoneNumber']);
                    $user->setPhoneNumber($phoneNumber);
                } else {
                    $phoneNumber = " ";
                    $user->setPhoneNumber($phoneNumber);
                }
                if (!empty($_POST['language'])) {
                    $user->setLanguage($_POST['language']);
                } else {
                    $user->setLanguage("");
                }
                if (isset($_POST['gitHub'])) {
                    $gitHub = $this->test_input($_POST['gitHub']);
                    $user->setGithub($gitHub);
                } else {
                    $gitHub = " ";
                    $user->setGithub($gitHub);
                }
                if (isset($_POST['linkedin'])) {
                    $linkedin = $this->test_input($_POST['linkedin']);
                    $user->setLinkedin($linkedin);
                } else {
                    $linkedin = " ";
                    $user->setLinkedin($linkedin);
                }
                if (isset($_POST['odyssey'])) {
                    $odyssey = $this->test_input($_POST['odyssey']);
                    $user->setOdyssey($odyssey);
                } else {
                    $odyssey = " ";
                    $user->setOdyssey($odyssey);
                }
                if (!empty($_POST['date'])) {
                    $userManager->updateBirthDate($id, $_POST['date']);
                } elseif (empty($_POST['date'])) {
                    $userManager->updateEmptyBirthDate($id);
                }
                if (!isset($_POST['lastName']) || empty($_POST['lastName']))
                    $error['lastName'] = "Ce champ ne peut être vide.";
                else {
                    $lastName = $this->test_input($_POST['lastName']);
                    $user->setLastName($lastName);
                }
                if (!isset($_POST['firstName']) || empty($_POST['firstName']))
                    $error['firstName'] = "Ce champ ne peut être vide.";
                else {
                    $firstName = $this->test_input($_POST['firstName']);
                    $user->setFirstName($firstName);
                }
                if (!isset($_POST['email']) || empty($_POST['email']) || !$this->isEmail($_POST['email']))
                    $error['email'] = "Ce champ ne peut pas être vide.";
                else {
                    $email = $this->test_input($_POST['email']);
                    $user->setEmail($email);
                }
                if ($_POST['isAdmin'] == "1") {
                    $user->setisAdmin(1);
                } else
                    $user->setisAdmin(0);
                $user->setId($userArray['id']);
                if (count($error) === 0)
                    $userManager->updateByAdmin($user);
                header('Location:/staff/user');
            }
            return $this->twig->render('Staff/modifyUser.html.twig', ['user' => $user = $userArray
            == null ? null : $userArray, 'errors' => $error, 'current' => 5]);
        }
    }

    /**
     * Staff's form for deleting student
     *
     * @param $id User to delete
     * @return void
     */
    public function userDelete($id)
    {
        if (!isset($_SESSION['user']))
            header('Location:/');
        elseif ($_SESSION['user']->getisAdmin() != 1)
            header('Location:/home');
        else{
            $userManager = new UserManager($this->getPdo());
            $filename = substr($userManager->readPhoto($id)[0], 1);
            if ($filename != "assets/images/logo.png")
                unlink($filename);
            $userManager->delete($id);
            header('Location:/staff/user');
        }
    }

    /**
     * Sending mail to users for initialisation
     *
     * @param User $user to init
     * @return void
     */
    public function sendMail(User $user)
    {
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
            ->setUsername('wildcodeschoolphpgp1lille@gmail.com')
            ->setPassword('jecode4lille');
        $mailer = new Swift_Mailer($transport);
        $message = (new Swift_Message('Wonderful Subject'))
            ->setFrom(['wildcodeschoolphpgp1lille@wildcodeschool.fr' => 'Wild'])
            ->setTo([$user->getEmail() => $user->getFirstName()])
            ->setBody('<a href="http://192.168.1.41:8000/init?code=' .
                $user->getCode() .
                '">Cliquez ici pour vous enregistrer</a>', 'text/html');
        $result = $mailer->send($message, $failures);
    }
}