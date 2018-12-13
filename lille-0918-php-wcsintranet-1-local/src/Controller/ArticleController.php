<?php
/**
 * ArticleController file
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

use Model\Article\Article;
use Model\Article\ArticleManager;
use Model\Category\Category;
use Model\Category\CategoryManager;
use Model\Comment\Comment;
use Model\Comment\CommentManager;
use Model\User\User;
use Model\User\UserManager;

/**
 * Article class controller
 *
 * @category Controller
 * @package  Controller
 */
class ArticleController extends AbstractController
{
    /**
     * Display articles
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @return string the rendered template
     */
    public function articles()
    {
        if (!$_SESSION['user'])
            header('Location:/');
        else {
            $articleManager = new ArticleManager($this->getPdo());
            $articles = $articleManager->selectAllArticles();
            $cm = new CategoryManager($this->getPdo());
            $categories = $cm->selectAllCategories();


            $category = '';
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $category = $_POST['id_category'];
                if ($category == 'all')
                    header('Location: /articles');
                else
                    $articles = $articleManager->showBySelect($category);
            }
        }
        return $this->twig->render('Article/articles.html.twig', [
            'articles' => $articles,
            'category' => $category,
            'categories' => $categories,
            'current' => 3
        ]);
    }

    /**
     * Adding an article
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @return string the rendered template
     */
    public function createArticle()
    {
        if (!$_SESSION['user'])
            header('Location:/');
        else {
            $cm = new CategoryManager($this->getPdo());
            $categories = $cm->selectAllCategories();
            $error = [];
            $validate = '';
            $article = new Article();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $subject = $this->test_input($_POST['subject']);
                $author = $_POST['author'];
                $content = $this->test_input($_POST['content']);
                $category = $_POST['category'];
                $idUser = $_SESSION['user']->getId();
                $userManager = new ArticleManager($this->getPdo());
                if (empty($subject) || !isset($subject)) {
                    $error['subject'] = "Ce champ ne peut être vide.";
                }
                if (empty($content) || !isset($content)) {
                    $error['content'] = "Vous devez ajouter du contenu.";
                }
                if (count($error) === 0) {
                    $article->setActiveCategory(0);
                    $article->setSubject($subject);
                    $article->setContent($content);
                    $article->setDate(date("Y-m-d"));
                    $article->setIdCategory($category);
                    $article->setAuthor($author);
                    $article->setUserId($idUser);
                    if ($_SESSION['user']->getisAdmin() == 1){
                        $article->setIsActif(1);
                        $validate = "Ton article vient d'être publié.";
                    } else {
                        $article->setIsActif(0);
                        $validate = "Ton article a bien été envoyé";
                    }
                    $userManager->add($article);
                }
            }
            return $this->twig->render(
                'Article/create.html.twig', [
                'articles' => $article,
                'categories' => $categories,
                'errors' => $error,
                'validate' => $validate,
                'current' => 3
            ]);
        }
    }

    /**
     * selecting an article by id and comments by article
     * @param int $id
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @return string
     */
    public function articleById(int $id)
    {
        if (!$_SESSION['user'])
            header('Location:/');
        else {
            $error = [];
            $comment = new Comment();
            $articleManager = new ArticleManager($this->getPdo());
            $article = $articleManager->selectOneArticlebyId($id);
            $commentManager = new CommentManager($this->getPdo());
            $comments = $commentManager->selectCommentByArticle($id);
            if (isset($_POST['content'])) {
                $content = $this->test_input($_POST['content']);
                $idArticle = $id;
                $idUser = $_SESSION['user']->getId();

                if (empty($content) || !isset($content)) {
                    $error['content'] = "Vous devez ajouter du contenu.";
                } else {
                    $comment->setIdUser($idUser);
                    $comment->setContent($content);
                    $comment->setDate(date("Y-m-d"));
                    $comment->setIdArticle($idArticle);
                    $commentManager->addComment($comment);
                    header('Location: /articles/' . $id . '#comments');
                }
            }
            return $this->twig->render('Article/articleById.html.twig', [
                'article' => $article,
                'comments' => $comments,
                'error' => $error,
                'comment' => $comment,
                'current' => 3
            ]);
        }
    }

    /**
     * delete a comment
     * @param int $id selecting comment
     * @return void
     */
    public function deleteComment(int $id)
    {

        if (!isset($_SESSION['user']))
            header('Location:/');
        else {
            $cm = new CommentManager($this->getPdo());
            $comment = new Comment();
            $comment->getIdArticle();
            $error = null;

            if (!($comment = $cm->selectCommentOneById($id))) {
                $errno = 1;
                $error = "Erreur dans la suppression du commentaire.";
            } elseif ($_SESSION['user']->getId() != $cm->selectCommentOneById($id)->getIdUser() && $_SESSION['user']->getIsAdmin() != 1) {
                $errno = 2;
                $error = "Tu ne peux pas supprimer ce commentaire.";
            }
            if (!$error) {
                $cm->delete($id);
                header("Location: /articles/$comment");
            } else {
                header("Location: /articles/$comment?errno=$errno");
            }
        }
    }

    /**
     * delete an article and his comments
     * @param int $id selecting article
     * @return void
     */
    public function suppressionArticle(int $id)
    {
        if (!isset($_SESSION['user']))
            header('Location:/');
        else {
            $am = new ArticleManager($this->getPdo());
            $commentManager = new CommentManager($this->getPdo());
            $commentManager->deleteCommentByArticle($id);
            $am->delete($id);
            header("Location: /articles");
        }
    }

    /**
     * show articles and categories
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @return string
     */
    public function articleView()
    {
        if (!isset($_SESSION['user']))
            header('Location:/');
        else {
            $articleManager = new ArticleManager($this->getPdo());
            $articles = $articleManager->selectAllArticles();

            $category = new Category();
            $error = null;
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = $this->test_input(htmlspecialchars($_POST['name']));
            }
            if (empty($name) || !isset($name)) {
                $error = "Vous devez ajouter une nouvelle catégorie.";
            } else {
                $cm = new CategoryManager($this->getPdo());
                $category->setName($name);
                $category->setIsActive(0);
                $cm->addCategory($category);
            }

            $cm = new CategoryManager($this->getPdo());
            $categories = $cm->selectAllCategories();

            return $this->twig->render('Article/viewArticle.html.twig', [
                'articles' => $articles,
                'category' => $category,
                'categories' => $categories,
                'error' => $error,
                'current' => 6
            ]);
        }
    }

    /**
     * validation article by Admin
     * @param int $id
     */
    public function articleValidate(int $id)
    {
        if (!isset($_SESSION['user']))
            header('Location:/');
        elseif ($_SESSION['user']->getisAdmin() != 1)
            header('Location:/home');
        else {
            $articleManager = new ArticleManager($this->getPdo());
            $articleManager->updateIsActif($id);
            header("Location: /article/view");
        }
    }

    /**
     * Refuse an article
     * @param int $id selecting article
     * @return void
     */
    public function articleDelete(int $id)
    {
        if (!isset($_SESSION['user']))
            header('Location:/');
        elseif ($_SESSION['user']->getisAdmin() != 1)
            header('Location:/home');
        else {
            $articleManager = new ArticleManager($this->getPdo());
            $articleManager->delete($id);
            header("Location: /article/view");
        }
    }

    /**
     * Selecting articles by category
     * @param int $id selecting category
     * @return string articles by category
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function articleByCategory(int $id)
    {
        if (!isset($_SESSION['user']))
            header('Location:/');
        elseif ($_SESSION['user']->getisAdmin() != 1)
            header('Location:/home');
        else {
            $articleManager = new ArticleManager($this->getPdo());
            $article = $articleManager->showBySelect($id);
        }

        return $this->twig->render('Article/articlesByCategory.html.twig', [
            'articles' => $article,
            'current' => 3
        ]);
    }

    /**
     * Update a category by id
     * @param int $id selecting category
     * @return string the new category
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function editCategory(int $id)
    {
        if (!$_SESSION['user'])
            header('Location:/');
        elseif ($_SESSION['user']->getisAdmin() != 1)
            header('Location:/home');
        else {
            $cm = new CategoryManager($this->getPdo());
            $categoryarray = $cm->selectOneById($id);
            $error = null;

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (empty($_POST['name']) || !isset($_POST['name'])) {
                    $error = "Ce champ ne peut pas être vide.";
                } else {
                    $cm = new CategoryManager($this->getPdo());
                    $category = new Category();
                    $name = $this->test_input(htmlspecialchars($_POST['name']));
                    $category->setId($id);
                    $category->setName($name);
                    $cm->updateCategory($category);

                    header('Location: /article/view#category');

                }
            }
            return $this->twig->render('Article/editCategory.html.twig', [
                'error' => $error,
                'category' => $category = $categoryarray == null ? null : $categoryarray,
                'current' => 2
            ]);
        }
    }

    /**
     * delete category
     * @param int $id selecting category
     * @return void
     */
    public function deleteCategory(int $id)
    {
        if (!isset($_SESSION['user']))
            header('Location:/');
        elseif ($_SESSION['user']->getisAdmin() != 1)
            header('Location:/home');
        else {
            $cm = new CategoryManager($this->getPdo());
            $cm->updateIsActive($id);
            $am = new ArticleManager($this->getPdo());
            $am->updateActiveCategory($id);
            header("Location: /article/view#category");
        }
    }
}