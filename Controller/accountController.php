<?php
    require_once("model/UserDB.php");
    require_once("ViewHelper.php");

    class accountController {
        public static function displayPage() {
            ViewHelper::render("View/signIn.php");
        }

        public static function login() {
            if (UserDB::validLoginAttempt($_POST["username"]) && password_verify($_POST["password"], UserDB::getHash($_POST["username"]))) {
                $vars = [
                    "username" => $_POST["username"],
                    "password" => $_POST["password"]
                ];

                $_SESSION["username"] = $_POST["username"];
                $_SESSION["logged_in"] = TRUE;
                ViewHelper::redirect(BASE_URL . "home");
            } else {
                $temp=UserDB::existedAccount($_POST["username"]);
                echo "Invalid data";
            }
        }

        public static function signup() {
            if (!isset($_POST["username"])) {
                die("Invalid request");
            }

            if (UserDB::existsUser($_POST["username"])) {
                $_SESSION["error1"] = TRUE;
                ViewHelper::render("View/signUp.php");
            }
            else {
                $pass = password_hash($_POST["password1"], PASSWORD_DEFAULT);
                UserDB::addUser($_POST["username"], $pass);
                ViewHelper::redirect("signIn");
            }
        }

        public static function oldEntry() {
            return UserDB::existedAccount($_SESSION["username"]);
        }

        public static function addEntry() {
            if (!isset($_POST["username"])) {
                die("Invalid request");
            }

            $allDiets="";

            if (isset($_POST["vegan"])) {
                $allDiets = $allDiets . "Vegan";
            }
            if (isset($_POST["pescetarian"])) {
                $allDiets = $allDiets . ",Pescetarian";
            }
            if (isset($_POST["ketogenic"])) {
                $allDiets = $allDiets . ",Ketogenic";
            }
            if (isset($_POST["vegetarain"])) {
                $allDiets = $allDiets . ",Vegetarain";
            }

            UserDB::addEntry($_SESSION["username"], $allDiets);

            ViewHelper::redirect(BASE_URL . "home");
        }

        public static function test() {
            echo "PUNON EDHE KJO";
        }
    }
?>