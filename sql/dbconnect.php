<?php session_start();

 function Connection(){
    global $connection;
    // připojení do databáze
    $connection = mysqli_connect("localhost","root","","smate");

    /* if($connection){
        echo "jsme propojeni";
    } else {
        die($p = '404');
    } */
}
function AddFun(){
    global $connection;
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO usersregistration(email, username, password, password_hash, date) VALUES ('$email','$username','$password', '$hashedPassword', current_timestamp())";

    $result = mysqli_query($connection,$query);

    if($result > 0){
        header("location: ?p=succes");
    }
}
function SelectFun(){

    if(isset($_POST["email"]) && isset($_POST["password"])){

    global $connection;
    global $result;
    $email = $_POST["email"];
    $password = $_POST["password"];

    if(empty($email)) {
        header("location: ?p=404");
        exit();
    } else if (empty($password)) {
        header("location: ?p=404");
        exit();
    } else {
        $query = "SELECT * FROM usersregistration WHERE email='$email' AND password='$password'";
        $result = mysqli_query($connection,$query);

        if(mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row["password_hash"])) {
                $_SESSION["email"] = $row["email"];
                $_SESSION["password"] = $row["password"];
                $_SESSION["id"] = $row["id"];
                header("location: ?p=homepage");
                exit();
            } else {
                header("location: ?p=404");
                exit();
            }
        } else {
            header("location: ?p=404");
            exit();
        }
    }
} else {
    header("location: ?p=succes");
    exit();
}
}   

?>


