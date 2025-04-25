<?php

session_start();

const SUBPAGE_TEMPLATE_PATH = "../templates/subPage/";
const GRAPHS_TEMPLATE_PATH = "../templates/subPage/graphs/";

const CONTENT_TEMPLATE_ASSOC_MAP = [
    1 => 'cryptoContentGraphs.html',
    2 => 'popularCryptoContentGraphs.html',
    3 => 'exchangesContentGraphs.html',
];

const SCRIPTS_TEMPLATE_ASSOC_MAP = [
    1 => 'cryptoScriptsGraphs.html',
    2 => 'scriptsPopularCryptoGraphs.html',
    3 => 'scriptsExchangeGraphs.html',
];


if (isset($_SESSION["Role"])) {
    if ($_SESSION["Role"] == "ADMIN") {
        $headAndHeader = file_get_contents(SUBPAGE_TEMPLATE_PATH . "adminHeadAndHeaderSubpage.html");
    } else {
        $headAndHeader = file_get_contents(SUBPAGE_TEMPLATE_PATH . "registeredHeadAndHeaderSubpage.html");
    }
    $template = $_GET['template'];
    $nameOfContentTemplate = CONTENT_TEMPLATE_ASSOC_MAP[$template];
    $nameOfScriptsTemplate = SCRIPTS_TEMPLATE_ASSOC_MAP[$template];

    $content = file_get_contents(GRAPHS_TEMPLATE_PATH . $nameOfContentTemplate);
    $scripts = file_get_contents(GRAPHS_TEMPLATE_PATH . $nameOfScriptsTemplate);
} else {
    $headAndHeader = file_get_contents(SUBPAGE_TEMPLATE_PATH . "unloggedHeadAndHeaderSubpage.html");
    $content = file_get_contents(SUBPAGE_TEMPLATE_PATH . "unauthorizedContentSubpage.html");
    $scripts = file_get_contents(GRAPHS_TEMPLATE_PATH . "defaultScriptsGraphs.html");
}

$footer = file_get_contents(SUBPAGE_TEMPLATE_PATH . "footerSubpage.html");

$builtHtmlFile = $headAndHeader . $content . $footer . $scripts;

echo $builtHtmlFile;