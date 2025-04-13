<?php

session_start();

const SUBPAGE_TEMPLATE_PATH = "../templates/subPage/";
const USER_LISTINGS_TEMPLATE_PATH = "../templates/subPage/userListings/";

if (isset($_SESSION["Role"])) {
    if ($_SESSION["Role"] == "ADMIN") {
        $headAndHeader = file_get_contents(SUBPAGE_TEMPLATE_PATH . "adminHeadAndHeaderSubpage.html");
        $content = file_get_contents(USER_LISTINGS_TEMPLATE_PATH . "contentUserListings.html");
    } else {
        $headAndHeader = file_get_contents(SUBPAGE_TEMPLATE_PATH . "registeredHeadAndHeaderSubpage.html");
        $content = file_get_contents(SUBPAGE_TEMPLATE_PATH . "unauthorizedContentSubpage.html");
    }
} else {
    $headAndHeader = file_get_contents(SUBPAGE_TEMPLATE_PATH . "unloggedHeadAndHeaderSubpage.html");
    $content = file_get_contents(SUBPAGE_TEMPLATE_PATH . "unauthorizedContentSubpage.html");
}

$footer = file_get_contents(SUBPAGE_TEMPLATE_PATH . "footerSubpage.html");

$scripts = file_get_contents(USER_LISTINGS_TEMPLATE_PATH . "scriptsUserListings.html");

$builtHtmlFile = $headAndHeader . $content . $footer . $scripts;

echo $builtHtmlFile;