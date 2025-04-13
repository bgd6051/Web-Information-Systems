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
    public function getUsername(): string
    {
        return $this->Username;
    }
    public function getPassword(): string
    {
        return $this->Password;
    }
    public function getRole(): string
    {
        return $this->Role;
    }
    public function getID_USER(): int
    {
        return $this->ID_USER;
    }

    public function titleHTML(): string
    {
        $separador = ",";
        return "<li>Username" . $separador . "Password" . $separador . "Role" . $separador . "Save changes</li>";
    }

    public function toHTML(): string
    {
        $usernameL = "<label for='nombreUsuario " . $this->Username . "'>Usuario</label>";
        $usernameI = "<input id='nombreUsuario " . $this->Username . "' type=text maxlength=32 value=" . $this->Username . '>';
        $username = $usernameL . $usernameI;
        $passwordL = "<label for='Contrasena " . $this->Username . "'>Contraseña</label>";
        $passwordI = "<input id='Contrasena " . $this->Username . "' type=text maxlength=32 value=" . $this->Password . '>';
        $password = $passwordL . $passwordI;
        $nombreRolL = "<label for='nombreRol " . $this->Username . "'>Rol</label>";
        $nombreRolI = "<input id='nombreRol " . $this->Username . "' type=text maxlength=32 value=" . $this->Role . ' disabled>';
        $nombreRol = $nombreRolL . $nombreRolI;
        $saveChanges = "<button onclick='saveChanges(\"" . $this->Username . "\")'>Save changes</button>";
        $deleteUser = "<button onclick='deleteUser(\"" . $this->Username . "\")'>Delete user</button>";
        return "<li>" . $username . $password . $nombreRol . $saveChanges . $deleteUser . "</li>";
    }
}