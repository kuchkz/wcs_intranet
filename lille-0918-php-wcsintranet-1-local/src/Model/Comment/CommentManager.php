<?php
/**
 * Comment manager file
 *
 * PHP Version 7.2
 *
 * @category Model
 * @package  Manager
 * @author   Julie Delmas <julie.delmas33@gmail.com>
 */
namespace Model\Comment;

use Model\AbstractManager;
use Model\Comment\Comment;

/**
 * Comment manager class
 *
 * @category Model
 * @package  Manager
 * @author   Julie Delmas <julie.delmas33@gmail.com>
 */

class CommentManager extends AbstractManager
{
    /**
     * Targeted table const
     */
    const TABLE = 'comment';

    /**
     *  Initializes this class.
     *
     * @param \PDO $pdo To use pdo into manager
     */
    public function __construct(\PDO $pdo)
    {
        parent::__construct(self::TABLE, $pdo);
    }

    /**
     * Get comments from database by idArticle.
     * git
     *
     * @param  int $id Selecting comment by idArticle
     *
     * @return array of objects
     */
    public function selectCommentByArticle(int $id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM user JOIN comment ON user.id = comment.idUser WHERE comment.idArticle = :idArticle ORDER BY comment.idArticle DESC");
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->bindValue(':idArticle', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * Get one row from database by ID.
     * git
     *
     * @param  int $id Selecting comment by id
     *
     * @return Comment Current comment according to given id
     */
    public function selectCommentOneById(int $id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE id=:id");
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchObject('Model\Comment\Comment');
    }

    /**
     * Adding comment in database.
     *
     * @param Comment $comment Given comment to insert
     *
     * @return int
     */
    public function addComment(Comment $comment): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table (idUser, content, date, idArticle) VALUES (:idUser, :content, :date, :idArticle)");
        $statement->bindValue('idUser', $comment->getIdUser(), \PDO::PARAM_INT);
        $statement->bindValue('content', $comment->getContent(), \PDO::PARAM_STR);
        $statement->bindValue('date', $comment->getDate(), \PDO::PARAM_STR);
        $statement->bindValue('idArticle', $comment->getIdArticle(), \PDO::PARAM_INT);

        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
        return null;
    }

    /**
     * Delete comments from database by idArticle.
     *
     * @param  int $id Selecting comment by id of article
     *
     * @return void
     */
    public function deleteCommentByArticle(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE idArticle=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}