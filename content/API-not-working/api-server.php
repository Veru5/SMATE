Ahoj
<?php
header('Content-Type: application/json; charset=utf-8');
include "pages/oop.php";

try {
    // Vytvoření instance PDO pro připojení k databázi
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Nastavení režimu chybového hlášení na výjimky
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Nastavení kódování pro komunikaci s databází
    $pdo->exec("set names utf8");
    
    // Pokud je požadavek typu GET a parametr "action" je "getData"
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'getData') {
        // Provedení dotazu na databázi
        $stmt = $pdo->query('SELECT * FROM thetable');
        // Získání výsledků jako asociativní pole
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Vrácení dat jako JSON odpověď
        header('Content-Type: application/json');
        echo json_encode($data);
    }
} catch (PDOException $e) {
    // Pokud dojde k chybě, zde se vypíše
    echo "Chyba připojení k databázi: " . $e->getMessage();
}

?>