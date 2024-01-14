<?php

namespace models;

require_once "../database.php";

class session
{
    private $id;
    private $ip;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    public function getDataLogin()
    {
        return $this->data_login;
    }

    public function setDataLogin($data_login)
    {
        $this->data_login = $data_login;
    }

    private $data_login;

    public static function Create($params)
    {
        $date = date('Y-m-d H:i:s');
        $database = new \Database("localhost", "3306", "giovanni", "1234");
        $pdo = $database->connect("ecommerce5E");
        $stm = $pdo->prepare("insert into ecommerce5E.sessions(ip,data_login,user_id)values (:ip,:data_login,:user_id)");
        $stm->bindParam(":ip", $params["ip"]);
        $stm->bindParam(":data_login", $date);
        $stm->bindParam(":user_id", $params["user_id"]);
        $stm->execute();
    }

    public static function Find($id)
    {
        $database = new \Database("localhost", "3306", "giovanni", "1234");
        $pdo = $database->connect("ecommerce5E");
        $stm = $pdo->prepare("select * from sessions where id=:id");
        $stm->bindParam("id", $id);
        if ($stm->execute()) {
            return $stm->fetchObject("session");
        } else {
            throw new PDOException("Errore nella find");
        }
    }
}
?>