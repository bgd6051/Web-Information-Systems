<?php

use \Mpdf\Mpdf;

spl_autoload_register(function ($class) {
    $directories = ['auth', 'databaseClasses', 'databaseClasses' . DIRECTORY_SEPARATOR . 'databaseModelClasses'];

    foreach ($directories as $dir) {
        $file = __DIR__ . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $class . '.php';

        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . '/vendor/autoload.php';

session_start();

$username = isset($_SESSION["Username"]) ? $_SESSION["Username"] : null;
$listado = isset($_POST["currentListingInHtml"]) ? $_POST["currentListingInHtml"] : null;
$numeroListado = isset($_POST["currentListing"]) ? $_POST["currentListing"] : null;
$ordenacion = isset($_POST["filterOrder"]) ? $_POST["filterOrder"] : null;
$nombreFiltro = isset($_POST["filterText"]) ? $_POST["filterText"] : null;
$filtro = isset($_POST["filterTextContent"]) ? $_POST["filterTextContent"] : null;

const SUBPAGE_TEMPLATE_PATH = "../web/templates/subPage/";
const LOGO_PATH = '../web/images/logo.png';
const NFILTER_LISTING_NAME = [
    0 => "Listado de criptomonedas",
    1 => "Listado de criptoactivos más populares",
    2 => "Listado de páginas de intercambio"
];

$content = file_get_contents(SUBPAGE_TEMPLATE_PATH . "unauthorizedDirectAccessContentSubpage.html");

if ($username == null) {
    echo $content;
    exit;
}

if (!isRegistered($username)) {
    echo $content;
    exit;
}

$response = createPDF($listado, $numeroListado, $ordenacion, $nombreFiltro, $filtro);

echo $response;

function isRegistered($username): bool
{
    $dbSelector = new DBSelector();
    $user = $dbSelector->getRegisteredUser($username);
    if (empty($user)) {
        return false;
    }
    return true;
}

function createPDF($listado, $numeroListado, $ordenacion, $nombreFiltro, $filtro)
{
    if ($listado == null) {
        return "Listado no proporcionado";
    }
    $listadoEstructurado = '<ul>'.$listado.'</ul>';

    $nombreDeListado = NFILTER_LISTING_NAME[$numeroListado];

    $logoHTML = '<img src="' . realpath(LOGO_PATH) . '" alt="cripton"/>';

    $mpdf = new Mpdf([
        'tempDir' => sys_get_temp_dir()
    ]);

    $mpdf->SetHTMLHeader('
    <div style="text-align: center; font-weight: bold;">
        ' . $logoHTML . '
    </div>');

    $mpdf->SetHTMLFooter('
    <table width="100%">
        <tr>
            <td width="33%">{DATE j-m-Y}</td>
            <td width="33%" align="center"> PDF generado desde la página del grupo70 </td>
            <td width="33%" style="text-align: right;">{PAGENO}/{nbpg}</td>
        </tr>
    </table>');

    $listStyle = '
    <style>
        ul {
            list-style-type: disc;
            margin-left: 20px;
        }
        li {
            margin-bottom: 4px;
        }
    </style>';

    $mpdf->WriteHTML($listStyle . ' <br><h3 style="text-align: center;">' . $nombreDeListado . '</h3> <br> <h4>' . $nombreFiltro . ': ' . $filtro . '<br>ordenacion: ' . $ordenacion . '<br></h4>' . $listadoEstructurado);

    $mpdf->Output($nombreDeListado . ".pdf", \Mpdf\Output\Destination::INLINE);
}

