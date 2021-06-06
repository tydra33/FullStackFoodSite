<?php

require_once("controller/accountController.php");
require_once("controller/recipeController.php");

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "Static/images/");
define("PICS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "Static/pics/");
define("SCRIPTS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "Static/scripts/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "Static/css/");

session_start();

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    "" => function () {
        ViewHelper::redirect(BASE_URL . "signIn");
    },
    "signIn" => function () {
        $_SESSION["logged_in"] = FALSE;
        $_SESSION["username"] = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            accountController::login();
        } else {
            accountController::displayPage();
        }
    },
    "signUp" => function() {
        ViewHelper::render("View/signUp.php");
    },
    "createAccount" => function() {
        accountController::signup();
    },
    "home" => function() {
        if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == TRUE) {
            if (accountController::oldEntry()) {
                ViewHelper::redirect("recipeDisplay");
            } else {
                ViewHelper::render("View/welcomePage.php");
            }
        }
        else {
            echo "Please log in";
        }
    },
    "addEntry" => function() {
        accountController::addEntry();
    },
    "recipeDisplay" => function () {
        if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] == FALSE) {
            die("Please log in");
        }

        recipeController::displayRecipes();
    },
    "recipePage" => function() {
        recipeController::searchApi();
    },
    "recipe" => function() {
        if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] == FALSE) {
            die("Please log in");
        }

        ViewHelper::render("View/readRecipe.php");
    },
    "addRecipe" => function() {
        if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] == FALSE) {
            die("Please log in");
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            recipeController::addRecipe($_POST["ingredients"], $_POST["instructions"], $_POST["diets"], $_POST["name"]);
        } else {
            ViewHelper::render("View/writeRecipe.php");
        }
    },
    "userPage" => function() {
        if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] == FALSE) {
            die("Please log in");
        }

        ViewHelper::render("View/userPage.php");
    },
    "changeRecipe" => function() {
        if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] == FALSE) {
            die("Please log in");
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            recipeController::editRecipe(trim($_POST["id"], '()'), $_POST["ingredients"], $_POST["instructions"], $_POST["diets"], $_POST["name"], $_POST["pic"]);
            ViewHelper::redirect("home");
        } else {
            ViewHelper::render("View/editRecipe.php");
        }
    },
    "upload" => function() {
        ViewHelper::render("View/upload.php");
    }
];

try {
    if (isset($urls[$path])) {
       $urls[$path]();
    } else {
        echo "No controller for '$path'";
    }
} catch (Exception $e) {
    echo "An error occurred: <pre>$e</pre>";
}