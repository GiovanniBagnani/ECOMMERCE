<?php

namespace models;

class cart
{
    private $id;
    private $user_id;
    private $product_id;
    private $quantita;

    function setId($id) {
        $this->id = $id;
    }

    function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    function setProductId($product_id) {
        $this->product_id = $product_id;
    }

    function setQuantita($quantita) {
        $this->quantita = $quantita;
    }

    function getId() {
        return $this->id;
    }

    function getShopperId() {
        return $this->user_id;
    }

    function getProductId() {
        return $this->product_id;
    }

    function getQuantita() {
        return $this->quantita;
    }
    private static function connectToDB() {
        $database = new \Database("localhost", "3306", "giovanni", "1234");
        return $database->connect("ecommerce5E");
    }
    public static function add($cartId, $productId, $quantita) {
        $conn = cart::connectToDB();
        $sql = $conn->prepare("insert into cart_products (cart_id,product_id,quantita) values (:cart_id,:product_id,:quantita)");
        $sql->bindParam(':cart_id', $cartId);
        $sql->bindParam(':product_id', $productId);
        $sql->bindParam(':quantita', $quantita);
        $sql->execute();
    }
}