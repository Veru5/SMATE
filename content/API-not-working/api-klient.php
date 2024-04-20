<?php


// Adresa API endpointu
$apiUrl = 'https://faros.wz.cz/form1/dataserver.php?action=getData';

try {
    // Vytvoření instance CURL
    $curl = curl_init();

    // Nastavení parametrů pro CURL požadavek
    curl_setopt($curl, CURLOPT_URL, $apiUrl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // Odeslání CURL požadavku
    $response = curl_exec($curl);

    // Kontrola, zda byla odpověď úspěšná
    if ($response === false) {
        throw new Exception('Nepodařilo se získat odpověď z API.');
    }

    // Dekódování JSON odpovědi na asociativní pole
    $data = json_decode($response, true);

    // Výpis dat z databáze
    if (!empty($data)) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>EC</th><th>Jméno</th><th>Příjmení</th><th>RČ</th><th>Adresa</th><th>Email</th></tr>";
        foreach ($data as $row) {
            echo "<tr><td>" . $row['id'] . "</td><td>" . $row['ec'] . "</td><td>" . $row['jmeno'] . "</td><td>" . $row['prijmeni'] . "</td><td>" . $row['rc'] . "</td><td>" . $row['adresa'] . "</td><td>" . $row['email'] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "Žádná data nebyla nalezena.";
    }

    // Uzavření CURL spojení
    curl_close($curl);
} catch (Exception $e) {
    // Zpracování chyby
    echo "Chyba: " . $e->getMessage();
}

?>