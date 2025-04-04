<?php

session_start();

CONST SUBPAGE_TEMPLATE_PATH = "../templates/subPage/";
CONST REGISTER_TEMPLATE_PATH = "../templates/subPage/register/";

if (isset($_SESSION["Username"])) {
    $headAndHeader = file_get_contents(SUBPAGE_TEMPLATE_PATH . "loggedHeadAndHeaderSubpage.html");
} else {
    $headAndHeader = file_get_contents(SUBPAGE_TEMPLATE_PATH . "unloggedHeadAndHeaderSubpage.html");
}

$content = file_get_contents(REGISTER_TEMPLATE_PATH . "contentRegister.html");

$footer = file_get_contents(SUBPAGE_TEMPLATE_PATH . "footerSubpage.html");

$scripts = file_get_contents(REGISTER_TEMPLATE_PATH . "scriptsRegister.html");

$builtHtmlFile = $headAndHeader . $content . $footer . $scripts;

echo $builtHtmlFile;