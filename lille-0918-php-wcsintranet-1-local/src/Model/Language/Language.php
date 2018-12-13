<?php

namespace Model\Language;

/**
 * Class Language
 */
class Language
{
    private $id;
    private $nameLanguage;

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
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNameLanguage()
    {
        return $this->nameLanguage;
    }

    /**
     * @param mixed $name
     */
    public function setNameLanguage($name): void
    {
        $this->nameLanguage = $name;
    }


}