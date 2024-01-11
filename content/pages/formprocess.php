<?php 

function Connection(){
    global $connection;
    // připojení do databáze
    $connection = mysqli_connect("localhost","root","","smate");
}
Connection();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "thetable";

$conn = new mysqli("localhost","root","","smate");

if ($conn->connect_error) {
    die("Připojení k databázi selhalo: " . $conn->connect_error);
}

// Získání dat z formuláře
$url = $_POST['url'];
$title = $_POST['title'];
$meta_description = $_POST['meta_description'];

// Uložení dat do MySQL databáze (tabulky "thetable")
$sql = "INSERT INTO thetable (url, title, meta_description) VALUES ('$url', '$title', '$meta_description')";

if ($conn->query($sql) === TRUE) {
    echo "Data byla úspěšně uložena do databáze.";
} else {
    echo "Chyba při ukládání dat: " . $conn->error;
}

// Uzavření spojení s databází
$conn->close();

?>