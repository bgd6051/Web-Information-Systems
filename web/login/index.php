<?php

session_start();

const SUBPAGE_TEMPLATE_PATH = "../templates/subPage/";
const LOGIN_TEMPLATE_PATH = "../templates/subPage/login/";

if (isset($_SESSION["Role"])) {
    if ($_SESSION["Role"] == "ADMIN") {
        $headAndHeader = file_get_contents(SUBPAGE_TEMPLATE_PATH . "adminHeadAndHeaderSubpage.html");
    } else {
        $headAndHeader = file_get_contents(SUBPAGE_TEMPLATE_PATH . "registeredHeadAndHeaderSubpage.html");
    }
} else {
    $headAndHeader = file_get_contents(SUBPAGE_TEMPLATE_PATH . "unloggedHeadAndHeaderSubpage.html");
}

$content = file_get_contents(LOGIN_TEMPLATE_PATH . "contentLogin.html");

$footer = file_get_contents(SUBPAGE_TEMPLATE_PATH . "footerSubpage.html");

$scripts = file_get_contents(LOGIN_TEMPLATE_PATH . "scriptsLogin.html");

$builtHtmlFile = $headAndHeader . $content . $footer . $scripts;

echo $builtHtmlFile;