<?php

    include "sql/dbconnect.php";
    Connection();

    if (isset($_POST["submit-log"])) {
        // Zde ukládáme e-mail do cookies
        $cookie_name = "user_login";
        $cookie_value = $_POST["email"];
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // Cookie expiruje za 30 dní
    
        SelectFun();
    }
?>
<!-- <script src="js/script.js"></script> -->
<h2>Přihlásit se!</h2>
<div class="container">
    <form action="" method="post">
        <div class="form-group">
            <input type="text" name="email" id="email" class="form-control" required>
            <label for="email" class="email">Email</label>
        </div>
        <div class="form-group">    
            <input type="password" name="password" id="password" class="form-control" required>
            <label for="password" class="password">Heslo</label>
        </div>
        <div class="submit">
            <button type="submit-log" name="submit-log" class="submit-log">Přihlásit se</a>
        </div>
    <div class="grid_cont">
        <div class="heslo">
            <a href="?p=forgotpass">Zapomenuté heslo</a>
        </div>
        <div class="logreg">
            <a href="?p=registration">Registrace</a>
        </div>
    </div>
    </form>
</div>

