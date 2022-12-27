<?php

    include "sql/dbconnect.php";
    Connection();

    if(isset($_POST["submit-log"])){
        SelectFun();
    }
?>

<div class="container">
    <img src="images/logo-C95659-left.svg" class="image">
    <form action="" method="post">
        <div class="form-group">
            <input type="text" name="email" id="email" class="form-control" required>
            <label for="email" class="email">Email</label>
        </div>
        <div class="form-group">    
            <input type="password" name="password" id="password" class="form-control" required>
            <label for="password" class="password">Heslo</label>
        </div>
        <div class="heslo">
            <a href="?p=forgotpass">Zapommněli jste své heslo?</a>
        </div>
        <div class="submit">
            <button type="submit-log" name="submit-log" class="submit-log">Přihlásit se</a>
        </div>
        <div class="back">
            <a href="?p=home">Zpět na hlavní stránku</a>
        </div>
    </form>
</div>
