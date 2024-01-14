<?php
require_once "../models/product.php";
require_once "../database.php";
require_once "../models/user.php";
require_once "../models/cart.php";

session_start();
$product = \models\product::find($_POST['id']);
$user = $_SESSION['current_user'];
var_dump($_SESSION['current_user']);
$id = $user->getId();
$database = new \Database("localhost", "3306", "giovanni", "1234");
$pdo = $database->connect("ecommerce5E");
$stm= $pdo->prepare("insert into ecommerce5E.carts(user_id) values(:user_id)");
$stm->bindParam(":user_id", $id);
$stm->execute();
$stm = $pdo->prepare("select id from carts where user_id == :id");
$stm->bindParam(':id', $id);
\models\cart::add($user->getId(), $product->getId(), $_POST['quantita']);
header('Location: http://localhost:8000/view/products/cart.php');
?>