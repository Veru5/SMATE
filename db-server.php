<?php
header('Content-Type: application/json; charset=utf-8');

// Definice informací o databázi smate.cz
/*
$host = "a054um.forpsi.com";
$database = "f163385";
$username = "f163385";
$password = "9Lb65cD3"; */

// Definice informací o databázi
$host = "localhost";
$database = "thetable";
$username = "root";
$password = "";

// Připojení k databázi MySQL
$connection = mysqli_connect($host, $username, $password, $database);

// Kontrola připojení
if (!$connection) {
    die("Chyba: Nelze se pĹ™ipojit k databĂˇzi!");
}

// Nastavení kódování
mysqli_query($connection, "set names utf8");

// Pokud je požadavek typu GET a parametr "action" je "getData"
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'getData') {
    // Vytvoření dotazu
    $sql = "SELECT * FROM thetable";

    // Odeslání dotazu
    $result = mysqli_query($connection, $sql);

    // Zpracování dat
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    // Odeslání dat jako JSON odpověď
    header('Content-Type: application/json');
    echo json_encode($data);
}

// Uzavření připojení k databázi
mysqli_close($connection);
?>