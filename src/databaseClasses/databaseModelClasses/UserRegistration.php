<?php
class UserRegistration
{
    private $Username;
    private $Password;
    private $Role;
    private $ID_USER;

    public function __construct(string $Username, string $Password, string $Role, ?int $ID_USER = null)  
    {
        $this->Username = $Username;
        $this->Password = $Password;
        $this->Role = $Role;
        $this->ID_USER = $ID_USER;
    }
    public function getUsername(): string {
        return $this->Username;
    }
    public function getPassword(): string {
        return $this->Password;
    }
    public function getRole(): string {
        return $this->Role;
    }
    public function getID_USER(): int {
        return $this->ID_USER;
    }

    public function titleHTML(): string {
        $separador = "</th><th>";
        return "<tr><th>Username".$separador."Password".$separador."Role</th></tr>";
    }

    public function toHTML(): string {
        $separador = "</td><td>";
        return "<tr><td>".$this->Username.$separador.$this->Password.$separador.
            $this->Role."</td></tr>";
    }
}   