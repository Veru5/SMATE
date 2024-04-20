<?php
$p = filter_input(INPUT_GET, 'p');
$pages = [
    'forgotpass' => "Zapomenuté heslo",
    'login' => "Přihásit se",
    'registration' => "Zaregistrovat se",
    '404' => "Stránka nenalezena",
    'home' => "",
    'succes' => "",
    'homepage' => "",
    'logout' => "",
    'analyzuj' => "",
    'test' => "",
    'formprocess' => "",
    'oop' => "",
    'api-server' => "",
    'api-klient' => "",
];
if (empty($p)) {
    $p = 'home';
} else if (!isset($pages[$p])) {
    $p = '404';
}