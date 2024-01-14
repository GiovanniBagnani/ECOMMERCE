<?php
require_once "../../models/product.php";
require_once "../../database.php";
require_once "../../models/user.php";
session_start();
?>
<html lang="">
<head>
    <title>
        pagina prodotti
    </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
    </style>
</head>
<body>
<header>
    <?php
    $user = $_SESSION["current_user"];
    if ($user->getRole() == 2) {
        echo '<a href="edit_product.php">Modifica prodotti</a>';
    }
    ?>
</header>

<h1>Prodotti</h1>
<a href="cart.php">carrello</a>
<a href="..\..\actions\logout.php">log out</a>

<?php
$products = \models\product::findAll();
if ($products) {
    foreach ($products as $product) { ?>
        <ul>
            <li><?php echo $product->getMarca() ?></li>
            <li><?php echo $product->getNome() ?></li>
            <li><?php echo $product->getPrezzo() ?></li>
        </ul>
        <form action="../../actions/add_to_cart.php" method="POST">
            <input type="number" name="quantita" placeholder="quantita">
            <input type="hidden" name="id" value="<?php echo $product->getId(); ?>">
            <button type="submit">Aggiungi al carrello</button>
        </form>
    <?php }
} else {
    echo "Non ci sono prodotti al momento!";
}
?>
</body>
</html>
