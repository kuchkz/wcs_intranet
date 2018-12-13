<?php

namespace Model\User;

use Model\AbstractManager;
use Model\User\User;

/**
 *
 */
class UserManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'user';

    /**
     *  Initializes this class.
     */
    public function __construct(\PDO $pdo)
    {
        parent::__construct(self::TABLE, $pdo);
    }


    /**
     * @param User $user
     * @return int
     */
    public function add(User $user): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table(email, firstName, lastName, isAdmin, code) VALUES (:email, :firstName, :lastName, :isAdmin, :code)");

        $statement->bindValue('email', $user->getEmail(), \PDO::PARAM_STR);
        $statement->bindValue('firstName', $user->getFirstName(), \PDO::PARAM_STR);
        $statement->bindValue('lastName', $user->getLastName(), \PDO::PARAM_STR);
        $statement->bindValue('isAdmin', $user->getisAdmin(), \PDO::PARAM_INT);
        $statement->bindValue('code', $user->getCode(), \PDO::PARAM_STR);

        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }

        return null;
    }

    /**
     * @param User $user
     * @return int|null
     */
    public function update(User $user): ?int
    {
        // prepared request
        $statement = $this->pdo
            ->prepare("UPDATE $this->table SET `phoneNumber` =:phoneNumber, `gitHub` = :gitHub, `linkedin` = :linkedin, `odyssey` = :odyssey WHERE id=:id");
        $statement->bindValue('id', $user->getId(), \PDO::PARAM_INT);
        $statement->bindValue('phoneNumber', $user->getPhoneNumber(), \PDO::PARAM_STR);
        $statement->bindValue('gitHub', $user->getGitHub(), \PDO::PARAM_STR);
        $statement->bindValue('linkedin', $user->getLinkedin(), \PDO::PARAM_STR);
        $statement->bindValue('odyssey', $user->getOdyssey(), \PDO::PARAM_STR);

        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
        return null;
    }

    /**
     * @param User $user
     * @return int|null
     */
    public function updateByAdmin(User $user): ?int
    {
        // prepared request
        $statement = $this->pdo
            ->prepare("UPDATE $this->table SET `email` = :email, `lastName` = :lastName, 
`firstName` = :firstName, `phoneNumber` =:phoneNumber, `gitHub` = :gitHub, `linkedin` = :linkedin, `odyssey` = :odyssey, 
`isAdmin` = :isAdmin WHERE id=:id");
        $statement->bindValue('id', $user->getId(), \PDO::PARAM_INT);
        $statement->bindValue('email', $user->getEmail(), \PDO::PARAM_STR);
        $statement->bindValue('lastName', $user->getLastName(), \PDO::PARAM_STR);
        $statement->bindValue('firstName', $user->getFirstName(), \PDO::PARAM_STR);
        $statement->bindValue('phoneNumber', $user->getPhoneNumber(), \PDO::PARAM_STR);
        $statement->bindValue('gitHub', $user->getGitHub(), \PDO::PARAM_STR);
        $statement->bindValue('linkedin', $user->getLinkedin(), \PDO::PARAM_STR);
        $statement->bindValue('odyssey', $user->getOdyssey(), \PDO::PARAM_STR);
        $statement->bindValue('isAdmin', $user->getisAdmin(), \PDO::PARAM_INT);

        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
        return null;
    }

    /**
     * @param User $user
     * @return int|null
     */
    public function init(User $user): ?int
    {
        // prepared request
        $statement = $this->pdo
            ->prepare("UPDATE $this->table SET `password` = :password WHERE id=:id");
        $statement->bindValue('id', $user->getId(), \PDO::PARAM_INT);

        $statement->bindValue('password', $user->getPassword(), \PDO::PARAM_STR);

        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
        return null;
    }

    public function codeDelete($id): ?intsetBirthDate
    {
        // prepared request
        $statement = $this->pdo
            ->prepare("UPDATE $this->table SET `code` = NULL WHERE `id` = '$id'");
        $statement->execute();
        return null;
    }

    public function updateEmptyBirthDate($id): ?intsetBirthDate
    {
        // prepared request
        $statement = $this->pdo
            ->prepare("UPDATE $this->table SET `birthDate` = NULL WHERE `id` = '$id'");
        $statement->execute();
        return null;
    }
    public function updateBirthDate($id, $birthDate): ?intsetBirthDate
    {
        // prepared request
        $statement = $this->pdo
            ->prepare("UPDATE $this->table SET `birthDate` = '$birthDate' WHERE `id`= '$id'");
        $statement->bindParam('birthDate', $birthDate, \PDO::PARAM_STR);
        $statement->execute();
        return null;
    }

    public function changePhoto($id, $avatar): int
    {
        // prepared request
        $statement = $this->pdo->prepare("UPDATE $this->table SET avatar = '$avatar' WHERE id = '$id'");
        $statement->bindParam('id', $id, \PDO::PARAM_INT);
        $statement->bindValue('avatar', "/assets/images/$id.png" , \PDO::PARAM_STR);

        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }

        return null;
    }
    public function readPhoto(int $id): ?array
    {
        $statement = $this->pdo->prepare("SELECT avatar FROM $this->table WHERE id = :id");
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        $avatar = $statement->fetch();
        return $avatar === false ? null : $avatar;
    }
    public function selectOneByLanguage(string $language)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE language=:language");
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->bindValue('language', $language, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function addUserToPromo ($idUser, $idPromo): ?int
    {
        $idPromo = intval($idPromo);
        $idUser = intval($idUser);
        $statement = $this->pdo
            ->prepare("UPDATE $this->table SET `idPromo` =:idPromo WHERE `id` =:idUser");
        $statement->bindParam('idUser', $idUser, \PDO::PARAM_INT);
        $statement->bindParam('idPromo', $idPromo, \PDO::PARAM_INT);


        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
        return null;
    }

    public function addUserToLanguage ($idUser, $idLanguage): ?int
    {
        $idLanguage = intval($idLanguage);
        $idUser = intval($idUser);
        $statement = $this->pdo
            ->prepare("UPDATE $this->table SET `idLanguage` =:idLanguage WHERE `id` =:idUser");
        $statement->bindParam('idUser', $idUser, \PDO::PARAM_INT);
        $statement->bindParam('idLanguage', $idLanguage, \PDO::PARAM_INT);


        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
        return null;
    }

    public function selectAllByPromo(string $promo)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE idPromo=:promo");
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->bindValue('promo', $promo, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function selectAllByLanguage(string $language)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE idLanguage=:language");
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->bindValue('language', $language, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function selectAllUsers()
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table LEFT JOIN promo ON user.idPromo = promo.id
LEFT JOIN language ON user.idLanguage = language.id");
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->execute();

        return $statement->fetchAll();
    }


    /**
     * @param $id
     * @return int|null
     */
    public function removeUserPromo($id): ?int
    {
        // prepared request
        $statement = $this->pdo
            ->prepare("UPDATE $this->table SET idPromo = NULL WHERE id=:id");
        $statement->bindParam('id', $id, \PDO::PARAM_INT);

        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
        return null;
    }

    /**
     * @param $id
     * @return int|null
     */
    public function removeUserLanguage($id): ?int
    {
        // prepared request
        $statement = $this->pdo
            ->prepare("UPDATE $this->table SET idLanguage = NULL WHERE id=:id");
        $statement->bindParam('id', $id, \PDO::PARAM_INT);

        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
        return null;
    }
}
