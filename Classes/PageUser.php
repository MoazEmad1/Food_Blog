<?php
class PageUser {
    private $firstName;
    private $lastName;
    private $userName;
    private $pass;
    private $dob;
    private $userID;
    private $lastSeen;

    function __construct($firstName,$lastName,$userName,$pass,$dob)
    {
        $this -> firstName = $firstName;
        $this -> lastName = $lastName;
        $this -> userName = $userName;
        $this -> pass = $pass;
        $this -> dob = $dob;
        //user getUSERQL
    }

    function getFirstName(){
        return $this -> firstName;
    }

    function getLastName(){
        return $this -> lastName;
    }

    function getUserName(){
        return $this -> userName;
    }

    function getDob(){
        return $this -> dob;
    }


    function setPass($newPass){
        $this->pass = $newPass;
    }

    function setUserName($newUser){
        $this->userName = $newUser;
    }

    function getUserIDSQL(){
        //sqlcode
    }
}
?>