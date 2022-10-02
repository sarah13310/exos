<?php

class User
{
    private Infos $infos;
    private $firstname;

    /**
     *
     * @return mixed|string
     */
    public function getFirstname(): mixed
    {
        return $this->firstname;
    }

    /**
     * @param mixed|string $firstname
     */
    public function setFirstname(mixed $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed|string
     */
    public function getName(): mixed
    {
        return $this->name;
    }

    /**
     * @param mixed|string $name
     */
    public function setName(mixed $name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed|string
     */
    public function getBirthday(): mixed
    {
        return $this->birthday;
    }

    /**
     * @param mixed|string $birthday
     */
    public function setBirthday(mixed $birthday): void
    {
        $this->birthday = $birthday;
    }

    private $name;
    private $birthday;
    private $genre;

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     */
    public function setGenre($genre): void
    {
        $this->genre = $genre;
    }

    public function __construct($name = "", $firstname = "", $birthday = "", $genre = "")
    {
        $this->name = $name;
        $this->firstname = $firstname;
        $this->birthday = $birthday;
        $this->genre = $genre;
    }

    public function setInfos($infos)
    {
        $this->infos=$infos;
    }

    public function  getInfos(){
        return $this->infos;
    }

}