<?php
/**
 * Article manager file
 *
 * PHP Version 7.2
 *
 * @category Model
 * @package  Manager
 * @author   Julie Delmas <julie.delmas33@gmail.com>
 */

namespace Model\Article;

use Model\AbstractManager;
use Model\Article\Article;

/**
 * Article manager class
 *
 * @category Model
 * @package  Manager
 * @author   Julie Delmas <julie.delmas33@gmail.com>
 */
class ArticleManager extends AbstractManager
{
    /**
     * Targeted table const
     */
    const TABLE = 'article';

    /**
     *  Initializes this class.
     *
     * @param \PDO $pdo To use pdo into manager
     */
    public function __construct(\PDO $pdo)
    {
        parent::__construct(self::TABLE, $pdo);
    }

    public function selectAllArticles()
    {
        if ($this->table === "article")
            $this->className .= "\Article";
        return $this->pdo->query("SELECT * FROM category JOIN article ON category.id = article.idCategory",
            \PDO::FETCH_OBJ)->fetchAll();
    }

    /**
     * Adding article to database.
     *git
     * @param  Article $article selecting article.
     *
     * @return int
     */
    public function add(Article $article): int
    {
            // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table (userId, subject, content, date, idCategory, author, isActif, activeCategory) VALUES (:userId, :subject, :content, :date, :idCategory, :author, :isActif, :activeCategory)");
        $statement->bindValue('userId', $article->getUserId(), \PDO::PARAM_INT);
        $statement->bindValue('subject', $article->getSubject(), \PDO::PARAM_STR);
        $statement->bindValue('content', $article->getContent(), \PDO::PARAM_STR);
        $statement->bindValue('date', $article->getDate(), \PDO::PARAM_STR);
        $statement->bindValue('idCategory', $article->getIdCategory(), \PDO::PARAM_INT);
        $statement->bindValue('author', $article->getAuthor(), \PDO::PARAM_STR);
        $statement->bindValue('isActif', $article->getisActif(), \PDO::PARAM_INT);
        $statement->bindValue('activeCategory', $article->getActiveCategory(), \PDO::PARAM_INT);

        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
        return null;
    }

    /**
     * Get one row from database by ID.
     *git
     * @param  int $id selecting article.
     *
     * @return Article showing one article by id.
     */
    public function selectOneArticlebyId(int $id): Article
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM category JOIN article ON category.id = article.idCategory WHERE article.id=:id");
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchObject('Model\Article\Article');
    }

    /**
     * Validate an article
     * @param int $id taking the article's id
     * @return void
     */
    public function updateIsActif(int $id): void
    {
        $statement = $this->pdo->prepare("UPDATE article SET isActif = 1 WHERE id =:id");
        $statement->execute([
            ':id'=> $id
        ]);
    }

    /**
     * Showing articles by category
     * @param int $id_category selecting article's category
     * @return array
     */
    public function showBySelect(int $id_category)
    {
        $statement = $this->pdo->prepare("SELECT * FROM category JOIN article ON category.id = article.idCategory WHERE idCategory=:idCategory");
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->bindValue('idCategory', $id_category, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    /**
     * Showing the 5 last articles
     * @return array showing 5 last articles.
     */
    public function LastArticles()
    {
        if ($this->table === "article")
            $this->className .= "\Article";
        return $this->pdo->query("SELECT * FROM category JOIN article ON category.id = article.idCategory ORDER BY article.id desc limit 5",
            \PDO::FETCH_OBJ)->fetchAll();
    }

    /**
     * deactivate an article
     * @param int $id taking the category id
     * @return void
     */
    public function updateActiveCategory(int $id): void
    {
        $statement = $this->pdo->prepare("UPDATE article SET activeCategory = 1 WHERE idCategory =:id");
        $statement->execute([
            ':id'=> $id
        ]);
    }
}
