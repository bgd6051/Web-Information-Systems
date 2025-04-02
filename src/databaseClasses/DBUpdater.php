<?php

class DBUpdater extends DBHandler{
    public function updateUserRegistration(UserRegistration $userRegistration): bool {
        $query = "UPDATE FINAL_USER_REGISTRATION SET username = ?, password = ?, 
            role = ? WHERE ID_USER = ?";
        return $this->executeQuery($query,
         ["sssi", $userRegistration->getUsername(), 
                    $userRegistration->getPassword(), 
                    $userRegistration->getRole(),
                    $userRegistration->getID_USER()] );
    }
}
