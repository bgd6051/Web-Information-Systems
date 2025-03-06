<?php
class UserRegistration
{
    private string $Username;
    private string $Password;
    private string $Role;
    private int $ID_USER;

    public function __construct(string $Username, string $Password, string $Role, int|null $ID_USER)  
    {
        $this->$Username = $Username;
        $this->$Password = $Password;
        $this->$Role = $Role;
        $this->$ID_USER = $ID_USER;
    }
    public function getUsername() {
        return $this->Username;
    }
    public function getPassword() {
        return $this->Password;
    }
    public function getRole() {
        return $this->Role;
    }
    public function getID_USER() {
        return $this->ID_USER;
    }
}   