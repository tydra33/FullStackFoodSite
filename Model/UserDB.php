<?php

require_once "DBInit.php";

class UserDB {

    // Returns true if a valid combination of a username and a password are provided.
    public static function validLoginAttempt($username) {
        $dbh = DBInit::getInstance();

        // !!! NEVER CONSTRUCT SQL QUERIES THIS WAY !!!
        // INSTEAD, ALWAYS USE PREPARED STATEMENTS AND BIND PARAMETERS!
        $query = "SELECT COUNT(id) FROM users WHERE username = :username";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        return $stmt->fetchColumn(0) == 1;
    }

    public static function getHash($username) {
        $dbh = DBInit::getInstance();

        $query = "SELECT password FROM users WHERE username = :username";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        return $stmt->fetchAll()[0]["password"];
    }

    public static function addUser($username, $password) {
        $dbh = DBInit::getInstance();

        $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->execute();
    }

    public static function existsUser($username) {
        $dbh = DBInit::getInstance();

        $query = "SELECT COUNT(username) FROM users WHERE username = :username";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        return $stmt->fetchColumn(0) == 1;
    }

    public static function existedAccount($username) {
        $dbh = DBInit::getInstance();

        $query = "SELECT COUNT(username) FROM userInfo WHERE username = :username";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        return $stmt->fetchColumn(0) == 1;
    }

    public static function addEntry($username, $diets) {
        $dbh = DBInit::getInstance();

        $query = "INSERT INTO userInfo (username, diets) VALUES (:username, :diets)";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":diets", $diets);
        $stmt->execute();
    }
}