<?php

class DBUpdater extends DBHandler {
    public function updateUserEmail($id, $newEmail) {
        $query = "UPDATE users SET email = ? WHERE id = ?";
        return $this->executeQuery($query, ["si", $newEmail, $id]);
    }
}
