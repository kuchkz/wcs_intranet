<?php
/**
 * Category manager file
 *
 * PHP Version 7.2
 *
 * @category Model
 * @package  Manager
 * @author   Julie Delmas <julie.delmas33@gmail.com>
 */

namespace Model\Category;

use Model\AbstractManager;
use Model\Category\Category;

/**
 * Category manager class
 *
 * @category Model
 * @package  Manager
 * @author   Julie Delmas <julie.delmas33@gmail.com>
 */
class CategoryManager extends AbstractManager
{
    /**
     * Targeted table const
     */
    const TABLE = 'category';

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
     * Get all row from database.
     *
     * @return array
     */
    public function selectAllCategories()
    {
        if ($this->table === "category")
            $this->className .= "\Category";
        return $this->pdo->query("SELECT * FROM $this->table",
            \PDO::FETCH_OBJ)->fetchAll();
    }

    /**
     * Adding category to database.
     * @param  Category $category selecting article.
     * @return int
     */
    public function addCategory(Category $category): int
    {
        $statement = $this->pdo->prepare("INSERT INTO $this->table (name, isActive) VALUES (:name, :isActive)");
        $statement->bindValue('name', $category->getName(), \PDO::PARAM_STR);
        $statement->bindValue('isActive', $category->getisActive(), \PDO::PARAM_STR);

        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
        return null;
    }

    /**
     * Method to change the name of one category
     * @param Category $category
     * @return int|null
     */
    public function updateCategory(Category $category): ?int
    {
        // prepared request
        $statement = $this->pdo
            ->prepare("UPDATE $this->table SET `name` =:name WHERE id=:id");
        $statement->bindValue('id', $category->getId(), \PDO::PARAM_INT);
        $statement->bindValue('name', $category->getName(), \PDO::PARAM_STR);

        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
        return null;
    }

    /**
     * deactivate a category
     * @param int $id taking the category id
     * @return void
     */
    public function updateIsActive(int $id): void
    {
        $statement = $this->pdo->prepare("UPDATE category SET isActive = 1 WHERE id =:id");
        $statement->execute([
            ':id'=> $id
        ]);
    }
}