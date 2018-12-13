<?php

namespace Model\Comment;

/**
 * Class Comment
 */
class Comment
{
    private $id;
    private $content;
    private $date;
    private $idArticle;
    private $idUser;

    public function __toString() {
        return $this->idArticle;
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
    public function getIdArticle()
    {
        return $this->idArticle;
    }

    /**
     * @param mixed $idArticle
     */
    public function setIdArticle($idArticle)
    {
        $this->idArticle = $idArticle;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }




}