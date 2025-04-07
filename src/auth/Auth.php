<?php

class Auth 
{
    private $username;
    private $password;

    public function __construct($username){
        $this->username = $username;
    } 

    public function setPassword($password){
        $this->password = $password;
    } 

    public function authenticate(){
        return $this->isLoginCorrect();
    } 

    private function isLoginCorrect(): bool{
        $user = $this->getFromDB();
        if($user == null){
            return false;
        } 
        if($user->getPassword() != $this->password){
            return false;
        }
        return true;
    } 

    public function editUsername($newUsername){
        $dbUpdater = new DBUpdater();
        $user = $this->getFromDB();
        if($user == null){
            return false;
        } 
        $newUser = new UserRegistration($newUsername, $user->getPassword(), 
                $user->getRole(), $user->getID_USER());
        if($dbUpdater->updateUserRegistration($newUser)){
            $this->username = $newUsername;
            return true;
        } 
        return false;
    } 

    public function editPassword($newPassword){
        $dbUpdater = new DBUpdater();
        $user = $this->getFromDB();
        if($user == null){
            return false;
        } 
        $newUser = new UserRegistration($user->getUsername(), $newPassword, 
                $user->getRole(), $user->getID_USER());
        if($dbUpdater->updateUserRegistration($newUser)){
            $this->password = $newPassword;
            return true;
        } 
        return false;
    } 

    public function getFromDB(){
        $dbSelector = new DBSelector();
        $user = $dbSelector->getRegisteredUser($this->username);
        if(empty($user)){
            return null;
        }
        return $user[0];
    }

    public function existInDB(){
        if($this->getFromDB() == null){
            return false;
        } 

        return true;
    } 
} 