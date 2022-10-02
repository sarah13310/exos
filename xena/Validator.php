<?php


class UniValidator
{

    protected $is_ok = false;
    protected $status = [];
    protected $patterns=[
        "mail"=>"/^[_a-z0-9-+]+(\.[_a-z0-9-+]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i",
        "date"=>"/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/",
        "password"=>"/^([A-Z])+([a-zA-Z0-9]+)*([@*?%!])+$/",
        "numeric"=>"[0-9]+",
        "alphabetic"=>"/^([A-Za-z]+)$/",
    ];

    public function is_valide($type, $value_string)
    {
        $value_string=trim($value_string);
        $pattern=$this->patterns[$type];

        if (strlen($value_string)==0){
            $this->status["empty_".$type]="vide";
        }
        $this->is_ok = (preg_match($pattern, $value_string));

        if (!$this->is_ok){
            $this->status["unformat_".$type]="format incorrecte";
        }
        return $this->is_ok;
    }

    public function is_same($expr1, $expr2)
    {
        $this->is_ok = ($expr1 == $expr2);
<<<<<<< HEAD
        if (!$this->is_ok){
            $this->status["same"]="different";
        }
=======
>>>>>>> origin/main
        return $this->is_ok;
    }

    public function is_length($len, $value_string)
    {
        $this->is_ok = (strlen($value_string) >= $len);
        return $this->is_ok;
    }

    public function is_equal_length($len, $value_string)
    {
        $this->is_ok = (strlen($value_string) == $len);
        return $this->is_ok;
    }

    public function is_validated()
    {
        return $this->is_ok;
    }

    public function status(){
        return $this->status;
    }

}


class Validator extends UniValidator{

    public function is_mail($value_string, $pattern = "/^[_a-z0-9-+]+(\.[_a-z0-9-+]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i")
    {
        if (empty($value_string)){
            $this->status["mail"]="vide";
        }
        /* ex adresse@gmail.com */
        $this->is_ok = (parent::is_pattern($pattern, $value_string));
        if (!$this->is_ok){
            $this->status["mail"]="format";
        }
        else
        {
            $this->status["mail"]="ok";
        }
        return $this->is_ok;
    }

    public function is_date($value_string, $pattern = "([0-9]{2}\/[0-9]{2}\/[0-9]{4})")
    {
        /* pattern dd/mm/YYYY */
        return (parent::is_pattern($pattern, $value_string));
    }

    public function is_password($value_string, $pattern = "/^([A-Z])+([a-zA-Z0-9]+)*([@*?%!])+$/")
    {
        /* au moins un caractère en majuscule */
        /* au moins un mot en alphanumérique */
        /* finir par un caractère non alphanumérique */
        return (parent::is_pattern($pattern, $value_string));
    }

}