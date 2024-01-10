<?php
    include "sql/dbconnect.php";
    Connection();

    if(isset($_POST["submit-reg"])){
        // Zde ukládáme uživatele do cookies
        $cookie_name = "user-registration";
        $cookie_value = json_encode([
            'username'=>$_POST["username"],
            'email' =>$_POST["email"]
        ]);

        setcookie($cookie_name, $cookie_value, time() + (86400*30), "/");

        AddFun();
    }
?>

<div class="container">
    <form action="" method="post">
    <div class="form-group">
            <input type="text" name="email" id="email" class="form-control" required>
            <label for="email" class="email">E-mail</label>
        </div>
        <div class="form-group">
            <input type="text" name="username" id="name" class="form-control" required>
            <label for="username" class="username">Jméno a příjmení</label>
        </div>
        <div class="form-group">
            <input type="password" name="password" id="password" class="form-control" required>
            <label for="password" class="password">Heslo</label>
        </div>
        <div class="agree">
            <input type="checkbox" name="agree" id="agree" value="yes">Registrací souhlasíte s <a href="#" title="obchodni-podminky">obchodními podmínkami</a> a <a href="#" title="osobni-udaje">podmínkami ochrany osobních údajů.</a>
        </div>
        <div class="submit">
            <button type="submit-reg" name="submit-reg" class="submit-reg">Zaregistrovat se</a>
        </div>
        <div class="back">
            <a href="?p=home">Zpět na hlavní stránku</a>
        </div>
    </form>
</div>