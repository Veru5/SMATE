<?php
// Připojení k databázi a potřebné funkce
include "sql/dbconnect.php";
Connection();

// Funkce pro resetování hesla
function resetPassword($email, $newPassword) {
    global $connection;

    // Hashování nového hesla
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Aktualizace hesla v databázi
    $query = "UPDATE usersregistration SET password = '$hashedPassword' WHERE email = '$email'";
    $result = mysqli_query($connection, $query);

    return $result;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Zpracování formuláře po odeslání
    $email = $_POST["email"];
    $newPassword = $_POST["new_password"];

    // Resetování hesla
    $resetResult = resetPassword($email, $newPassword);

    if ($resetResult) {
        echo "Heslo bylo úspěšně resetováno.";
    } else {
        echo "Chyba při resetování hesla.";
    }
}
?>
<div class="container">
    <form action="" method="post">
        <div class="form-group">
            <input type="email" name="email" id="email" class="form-control" required>
            <label for="email" class="email">Zadejte Váš email</label>
        </div>
        <div class="form-group">
        <input type="password" name="new_password" id="new_password" class="form-control"required>
            <label for="new_password">Nové heslo</label>
        </div>
        <div class="submit">
            <button type="submit" name="submit" class="submit-log">Odeslat</a>
        </div>
        <div class="back">
            <a href="?p=home">Zpět na hlavní stránku</a>
        </div>
    </form>
</div>