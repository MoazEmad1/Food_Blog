<?php
class Admin{
    private $userName;
    private $pass;
    private $typeOfAuth;

    function __construct($userName,$pass,$typeOfAuth)
    {
        $this ->userName = $userName;
        $this ->pass = $pass;
        $this ->typeOfAuth = $typeOfAuth;
    }

    function getUserName(){
        return $this->userName;
    }
    function getTypeOfAuth(){
        return $this -> typeOfAuth;
    }
}
?>