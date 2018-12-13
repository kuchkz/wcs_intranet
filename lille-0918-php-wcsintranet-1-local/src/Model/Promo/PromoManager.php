<?php

namespace Model\Promo;

use Model\AbstractManager;
use Model\Promo\Promo;

/**
 *
 */
class PromoManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'promo';

    /**
     *  Initializes this class.
     */
    public function __construct(\PDO $pdo)
    {
        parent::__construct(self::TABLE, $pdo);
    }


    /**
     * @param Promo $promo
     * @return int
     */
    public function add(Promo $promo): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table(name) VALUES (:name)");

        $statement->bindValue('name', $promo->getName(), \PDO::PARAM_STR);


        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }

        return null;
    }


}
