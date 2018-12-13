<?php

namespace Model;

use Model\User\User;
use Model\Promo\Promo;

/**
 * Abstract class handling default manager.
 */
abstract class AbstractManager
{
    /**
     * @var \PDO
     */
    protected $pdo; //variable de connexion

    /**
     * @var string
     */
    protected $table;
    /**
     * @var string
     */
    protected $className;


    /**
     * Initializes Manager Abstract class.
     * @param string $table
     * @param PDO $pdo
     */
    public function __construct(string $table, \PDO $pdo)
    {
        $this->table = $table;
        $this->className = __NAMESPACE__ . '\\' . ucfirst($table);
        $this->pdo = $pdo;
    }

    /**
     * Get all row from database.
     *
     * @return array
     */
    public function selectAll(): array
    {
        if ($this->table === "user")
            $this->className .= "\User";
        elseif ($this->table === "article")
            $this->className .= "\Article";
        elseif ($this->table === "comment")
            $this->className .= "\Comment";
        elseif ($this->table === "promo")
            $this->className .= "\Promo";
        elseif ($this->table === "language")
            $this->className .= "\Language";
        return $this->pdo->query('SELECT * FROM ' . $this->table, \PDO::FETCH_CLASS, $this->className)->fetchAll();
    }

    /**
     * Get one row from database by ID.
     *git
     * @param  int $id
     *
     * @return array
     */
    public function selectOneById(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE id=:id");
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
    /**
     * Get one row from database by code.
     *
     * @param  int $code
     *
     * @return array
     */
    public function selectOneByCode($code)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE code=:code");
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->bindValue(':code', $code, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    /**
     * Get one row from database by email.
     *
     * @param  string $email Given user's email
     *
     * @return array|null User's information
     */
    public function selectOneByEmail(string $email)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE email=:email");
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->bindValue('email', $email, \PDO::PARAM_STR);
        $statement->execute();

        $tuple = $statement->fetchObject("Model\User\User");
        return $tuple === false ? null : $tuple;
    }

    public function selectOneByGrade(int $isAdmin)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE isAdmin=:isAdmin");
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->bindValue(':isAdmin', $isAdmin, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function delete(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}