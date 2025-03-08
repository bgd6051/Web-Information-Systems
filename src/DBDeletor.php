<?php
const TABLES_TO_DELETE = [
    "FINAL_EXCHANGE_RATE",
    "FINAL_SUPPORTED_COINS",
    "FINAL_TRENDING_COINS",
    "FINAL_COINS",
    "FINAL_EXCHANGES"
];

class DBDeletor extends DBHandler {

    public function deleteAllIntormationFromTables(): bool {
        foreach (TABLES_TO_DELETE as $table) {
            $query = "DELETE FROM $table";
            $queryResponse = $this->executeQuery($query);
            if (!$queryResponse) { return false; }
        }
        return true;
    }
    
}
