<?php
    require_once("model/RecipeDB.php");
    require_once("ViewHelper.php");

    class recipeController {
       public static function getRecipes($diets) {
            $tempString = "";

            foreach (RecipeDB::getRecipes($diets) as $val) {
                foreach ($val as $vellju) {
                    $tempString = $tempString . $vellju . " ";
                }
                $tempString = $tempString . "\n"; 
            }

            return trim(preg_replace('/\s\s+/', ',', $tempString));
       }

       public static function displayRecipes() {
            ViewHelper::render("View/recipesAjax.php");
       }

       public static function searchApi() {
            if(isset($_GET["query"]) && !empty($_GET["query"])) {
                $hits = RecipeDB::getRecipesByName($_GET["query"], $_SESSION["username"]);
            } else {
                $hits = [];
            }

            header('Content-type: application/json; charset=utf-8');
            echo json_encode($hits);
        }

        public static function addRecipe($ingredients, $instrunctions, $diets, $name) {
            $ingredients = filter_var($ingredients, FILTER_SANITIZE_SPECIAL_CHARS);
            $instrunctions = filter_var($instrunctions, FILTER_SANITIZE_SPECIAL_CHARS);
            $diets = filter_var($diets, FILTER_SANITIZE_SPECIAL_CHARS);
            $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);

            if (empty($title)) {
                echo "ERROR";
            } else {
                RecipeDB::addRecipe($_SESSION["username"], $ingredients, $instrunctions, $diets, $name);
                ViewHelper::redirect("home");
            }
        }

        public static function getRecipeById($id) {
            return RecipeDB::getRecipeById($id);
        }

        public static function getRecipesByAuthor($id) {
            return RecipeDB::getRecipesByAuthor($id);
        }

        public static function editRecipe($id, $ingredients, $instructions, $diets, $name) {
            $ingredients = filter_var($ingredients, FILTER_SANITIZE_SPECIAL_CHARS);
            $instrunctions = filter_var($instrunctions, FILTER_SANITIZE_SPECIAL_CHARS);
            $diets = filter_var($diets, FILTER_SANITIZE_SPECIAL_CHARS);
            $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);

            return RecipeDB::editRecipe($id, $ingredients, $instructions, $diets, $name);
        }

        public static function getId(){
            return RecipeDB::getId();
        }
    }