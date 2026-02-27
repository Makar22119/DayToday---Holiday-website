<?php

class Dbh {
    private $dsn = "mysql:host=localhost;dbname=day_todaydb";
    private $dbUser = "root";
    private $dbPwd = "";

    public function connect(){
        try {
            $pdo = new PDO($this->dsn, $this->dbUser, $this->dbPwd);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            header('Location: ./notFound.html');
            die("Connection failed: " . $e->getMessage());
        }
    }
}