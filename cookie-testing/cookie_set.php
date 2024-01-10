<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting Cookie</title>
</head>
<body>

<?php 
$ExpireTime = time()+86400;
setcookie("name", "Veronika", $ExpireTime);
setcookie("age", "33", $ExpireTime);
// print_r($_COOKIE);
echo $_COOKIE["name"]."<br>";
echo 'My name is :'. $_COOKIE["name"].' and my age is: '.$_COOKIE["age"];

?>

</body>
</html>