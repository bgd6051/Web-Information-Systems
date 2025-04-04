<?php

session_start();

CONST SUBPAGE_TEMPLATE_PATH = "../templates/subPage/";
CONST LISTINGS_TEMPLATE_PATH = "../templates/subPage/listings/";

if (isset($_SESSION["Username"])) {
    $headAndHeader = file_get_contents(SUBPAGE_TEMPLATE_PATH . "loggedHeadAndHeaderSubpage.html");
    $content = file_get_contents(LISTINGS_TEMPLATE_PATH . "loggedContentListings.html");
} else {
    $headAndHeader = file_get_contents(SUBPAGE_TEMPLATE_PATH . "unloggedHeadAndHeaderSubpage.html");
    $content = file_get_contents(LISTINGS_TEMPLATE_PATH . "unloggedContentListings.html");
}

$footer = file_get_contents(SUBPAGE_TEMPLATE_PATH . "footerSubpage.html");

$scripts = file_get_contents(LISTINGS_TEMPLATE_PATH . "scriptsListings.html");

$builtHtmlFile = $headAndHeader . $content . $footer . $scripts;

echo $builtHtmlFile;