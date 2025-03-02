<?php
phpinfo();

$insertor = new DBInsertor();
$insertor->insertUser("John Doe", "john@example.com");

$updater = new DBUpdater();
$updater->updateUserEmail(1, "newemail@example.com");

$deletor = new DBDeletor();
$deletor->deleteUser(1);