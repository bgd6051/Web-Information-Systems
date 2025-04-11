<?php

session_start();

CONST SUBPAGE_TEMPLATE_PATH = "../templates/subPage/";
CONST UPDATING_TEMPLATE_PATH = "../templates/subPage/updating/";

if (isset($_SESSION["Role"])) {
    if(isset($_SESSION["Role"]) && $_SESSION["Role"] == "ADMIN") {
        $headAndHeader = file_get_contents(SUBPAGE_TEMPLATE_PATH . "adminHeadAndHeaderSubpage.html");
        $content = file_get_contents(UPDATING_TEMPLATE_PATH . "contentUpdating.html");
    } else {
        $headAndHeader = file_get_contents(SUBPAGE_TEMPLATE_PATH . "registeredHeadAndHeaderSubpage.html");
        $content = file_get_contents(SUBPAGE_TEMPLATE_PATH . "unauthorizedContentSubpage.html");
    }
} else {
    $headAndHeader = file_get_contents(SUBPAGE_TEMPLATE_PATH . "unloggedHeadAndHeaderSubpage.html");
    $content = file_get_contents(SUBPAGE_TEMPLATE_PATH . "unauthorizedContentSubpage.html");
}

$footer = file_get_contents(SUBPAGE_TEMPLATE_PATH . "footerSubpage.html");

$scripts = file_get_contents(UPDATING_TEMPLATE_PATH . "scriptsUpdating.html");

$builtHtmlFile = $headAndHeader . $content . $footer . $scripts;


echo $builtHtmlFile;