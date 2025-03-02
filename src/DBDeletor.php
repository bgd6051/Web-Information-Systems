<?php

class DBDeletor extends DBHandler {
    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = ?";
        return $this->executeQuery($query, ["i", $id]);
    }
}
