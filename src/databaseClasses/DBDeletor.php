<?php
const TABLES_TO_DELETE = [
    "FINAL_COINS_CHART",
    "FINAL_COINS",
    "FINAL_EXCHANGES",
    "FINAL_TRENDING_COINS",
    "FINAL_TRENDING_NFTS"
];

class DBDeletor extends DBHandler {

    public function deleteAllIntormationFromTables(): bool {
        foreach (TABLES_TO_DELETE as $table) {
            $query = "DELETE FROM $table";
            $queryResponse = $this->executeQuery($query);
            if (!$queryResponse) { return false; }
            $query = "ALTER TABLE $table AUTO_INCREMENT = 1";
            $queryResponse = $this->executeQuery($query);
            if (!$queryResponse) { return false; }
        }
        return true;
    }
    
}
