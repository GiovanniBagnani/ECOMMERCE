<?php

namespace models;

use PDO;

class product
{
    private $nome;
    private $prezzo;
    private $marca;
    private $id;

    public function getId()
    {
        return $this->id;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function getPrezzo()
    {
        return $this->prezzo;
    }
    public function setPrezzo($prezzo)
    {
        $this->prezzo = $prezzo;
    }
    public function getMarca()
    {
        return $this->marca;
    }
    public function setMarca($marca)
    {
        $this->marca = $marca;
    }
    private static function connectToDB() {
        $database = new \Database("localhost", "3306", "giovanni", "1234");
        return $database->connect("ecommerce5E");
    }
    public static function findAll()
    {
        $pdo = product::connectToDB();
        $stm = $pdo->prepare("select id, nome, prezzo, marca from products");
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_CLASS, product::class);//restituisce un istanza della classe product con il risultato della query o false
    }
    public static function find($id) {
        $pdo = product::connectToDB();
        $stm = $pdo->prepare("select * from ecommerce5e.products where id = $id");
        $stm->execute();
        return $stm->fetchObject('models\product');
    }
}