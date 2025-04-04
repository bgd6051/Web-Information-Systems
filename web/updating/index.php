<?php

session_start();

CONST SUBPAGE_TEMPLATE_PATH = "../templates/subPage/";
CONST UPDATING_TEMPLATE_PATH = "../templates/subPage/updating/";

if (isset($_SESSION["Username"])) {
    $headAndHeader = file_get_contents(SUBPAGE_TEMPLATE_PATH . "loggedHeadAndHeaderSubpage.html");
} else {
    $headAndHeader = file_get_contents(SUBPAGE_TEMPLATE_PATH . "unloggedHeadAndHeaderSubpage.html");
}

$content = file_get_contents(UPDATING_TEMPLATE_PATH . "contentUpdating.html");

$footer = file_get_contents(SUBPAGE_TEMPLATE_PATH . "footerSubpage.html");

$scripts = file_get_contents(UPDATING_TEMPLATE_PATH . "scriptsUpdating.html");

$builtHtmlFile = $headAndHeader . $content . $footer . $scripts;


echo $builtHtmlFile;