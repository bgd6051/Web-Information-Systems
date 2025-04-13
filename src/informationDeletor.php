<?php

spl_autoload_register(function ($class) {
    $directories = ['requestClasses', 'databaseClasses', 'databaseClasses' . DIRECTORY_SEPARATOR . 'databaseModelClasses', 'auth'];

    foreach ($directories as $dir) {
        $file = __DIR__ . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

session_start();

$username = isset($_SESSION["Username"]) ? $_SESSION["Username"] : null;
$role = isset($_SESSION["Role"]) ? $_SESSION["Role"] : null;

const SUBPAGE_TEMPLATE_PATH = "../web/templates/subPage/";
$content = file_get_contents(SUBPAGE_TEMPLATE_PATH . "unauthorizedMainDirectAccessContentSubpage.html");

if ($username == null || $role == null) {
    echo $content;
    exit;
}

$auth = new Auth($username);
if (!$auth->existInDB()) {
    echo $content;
    exit;
}
$admin = $auth->getFromDB();
if ($admin->getRole() != "ADMIN") {
    echo $content;
    exit;
}

$adminId = $admin->getID_USER();

$output = '';

$output .= "Eliminando contenido de las tablas...<br>";

$ejecucionCorrecta = true;

$deleteDate = date('Y-m-d H:i:s');

try {
    $dbDeletor = new DBDeletor();
    $responseCode = $dbDeletor->deleteAllIntormationFromTables();
    if (!$responseCode) {
        $output .= "Ha habido algún problema eliminando el contenido de las tablas<br>";
        $ejecucionCorrecta = false;
    }
} catch (Exception $e) {
    $output .= "Error: " . $e->getMessage();
}

try {
    $dbInsertor = new DBInsertor();
    $adminlog = new AdminLog($adminId, "DELETE", $deleteDate);

    $responseCode = $dbInsertor->insertAdminLog($adminlog);
    if (!$responseCode) {
        $output .= "Ha habido algún problema insertando el log del cambio<br>";
        $ejecucionCorrecta = false;
    }

} catch (Exception $e) {
    $output .= "Error: " . $e->getMessage();
}

if ($ejecucionCorrecta) {
    $output .= "Información de las tablas eliminadas correctamente<br>";
    $output .= "Fecha de eliminación: " . $deleteDate . "<br>";
} else {
    $output .= "No se ha podido eliminar la información de las tablas <br>";
}

echo $output;