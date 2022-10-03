<?php

class Infos
{
    private $mail;
    private $password;
    private array $langages=[];

    /**
     * @return array
     */
    public function getLangages(): array
    {
        return $this->langages;
    }

    /**
     * @param array $langages
     */
    public function setLangages(array $langages): void
    {
        $this->langages = $langages;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail): void
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function __construct(string $mail,string $password, array $langages=[]){
        $this->mail=$mail;
        $this->password=$password;
        if ($langages!=null){
            $this->langages=$langages;
        }
    }
}