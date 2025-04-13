<?php

session_start();

const MAIN_PAGE_TEMPLATE_PATH = "./web/templates/mainPage/";

if (isset($_SESSION["Role"])) {
    if ($_SESSION["Role"] == "ADMIN") {
        $headAndHeader = file_get_contents(MAIN_PAGE_TEMPLATE_PATH . "adminHeadAndHeaderMainPage.html");
        $content = file_get_contents(MAIN_PAGE_TEMPLATE_PATH . "adminContentMainPage.html");
    } else {
        $headAndHeader = file_get_contents(MAIN_PAGE_TEMPLATE_PATH . "registeredHeadAndHeaderMainPage.html");
        $content = file_get_contents(MAIN_PAGE_TEMPLATE_PATH . "registeredContentMainPage.html");
    }
} else {
    $headAndHeader = file_get_contents(MAIN_PAGE_TEMPLATE_PATH . "unloggedHeadAndHeaderMainPage.html");
    $content = file_get_contents(MAIN_PAGE_TEMPLATE_PATH . "unloggedContentMainPage.html");
}

$footerAndScripts = file_get_contents(MAIN_PAGE_TEMPLATE_PATH . "footerAndScriptsMainPage.html");

$builtHtmlFile = $headAndHeader . $content . $footerAndScripts;

echo $builtHtmlFile;