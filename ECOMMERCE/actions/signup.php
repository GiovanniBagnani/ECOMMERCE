<?php
require_once "../database.php";

$email = strtolower($_POST['email']);
$password = $_POST['password'];
$password_confirmation = $_POST['password-confirmation'];
if (strcmp($password, $password_confirmation) > 0) {
    header('Location: http://localhost:63342/views/signup.php');
    exit;
}

$database = new database("localhost", "3306", "giovanni", "1234");
$pdo = $database->connect("ecommerce5E");


$sql = $pdo->prepare("select id from ecommerce5E.users where email=:email limit 1;");
$sql->bindParam(":email", $email);
$sql->execute();

$users = $sql->fetchAll();

if (count($users) > 0) {
    header('Location: http://localhost:8000/view/signup.php');
    exit;
}
$password_hash = hash('sha256', $password);
$sql = $pdo->prepare("insert into ecommerce5E.users (email,password,role_id) values (:email,:password,'1');");
$sql->bindParam(":email", $email);
$sql->bindParam(":password", $password_hash);

if ($sql->execute()) {
    header('Location: http://localhost:8000/view/login.php');
    exit;
} else {
    header('Location: http://localhost:8000/view/signup.php');
    exit;
}
?>