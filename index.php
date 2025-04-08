<?php

session_start();

CONST MAIN_PAGE_TEMPLATE_PATH = "./web/templates/mainPage/";

if (isset($_SESSION["Role"])) {
    if(isset($_SESSION["Role"]) && $_SESSION["Role"] == "ADMIN") {
        $headAndHeader = file_get_contents(MAIN_PAGE_TEMPLATE_PATH . "adminHeadAndHeaderMainPage.html");
    } else {
        $headAndHeader = file_get_contents(MAIN_PAGE_TEMPLATE_PATH . "registeredHeadAndHeaderMainPage.html");
    }
} else {
    $headAndHeader = file_get_contents(MAIN_PAGE_TEMPLATE_PATH . "unloggedHeadAndHeaderMainPage.html");
}

$content = file_get_contents(MAIN_PAGE_TEMPLATE_PATH . "contentMainPage.html");

$footerAndScripts = file_get_contents(MAIN_PAGE_TEMPLATE_PATH . "footerAndScriptsMainPage.html");

$builtHtmlFile = $headAndHeader . $content . $footerAndScripts;

echo $builtHtmlFile;