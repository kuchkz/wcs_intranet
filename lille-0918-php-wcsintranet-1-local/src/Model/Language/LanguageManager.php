<?php

namespace Model\Language;

use Model\AbstractManager;
use Model\Language\Language;

/**
 *
 */
class LanguageManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'language';

    /**
     *  Initializes this class.
     */
    public function __construct(\PDO $pdo)
    {
        parent::__construct(self::TABLE, $pdo);
    }


    /**
     * @param Language $language
     * @return int
     */
    public function add(Language $language): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table(nameLanguage) VALUES (:name)");

        $statement->bindValue('name', $language->getNameLanguage(), \PDO::PARAM_STR);


        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }

        return null;
    }
}
