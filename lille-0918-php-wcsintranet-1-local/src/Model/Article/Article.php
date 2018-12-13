<?php

namespace Model\Article;

/**
 * Class Article
 */
class Article
{
    private $id;
    private $subject;
    private $content;
    private $date;
    private $userId;
    private $idCategory;
    private $author;
    private $isActif;
    private $activeCategory;

    /**
     * @return mixed
     */
    public function getIsActif()
    {
        return $this->isActif;
    }

    /**
     * @param mixed $isActif
     */
    public function setIsActif($isActif)
    {
        $this->isActif = $isActif;
    }


    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getIdCategory()
    {
        return $this->idCategory;
    }

    /**
     * @param mixed $idCategory
     */
    public function setIdCategory($idCategory)
    {
        $this->idCategory = $idCategory;
    }

    /**
     * @return mixed
     */
    public function getActiveCategory()
    {
        return $this->activeCategory;
    }

    /**
     * @param mixed $activeCategory
     */
    public function setActiveCategory($activeCategory): void
    {
        $this->activeCategory = $activeCategory;
    }


}
