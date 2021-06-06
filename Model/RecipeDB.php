<?php

require_once "DBInit.php";

class RecipeDB {

    public static function getRecipes($diets) {
        $dbh = DBInit::getInstance();

        $query = "SELECT name FROM recipes WHERE diets LIKE :diets";
        $stmt = $dbh->prepare($query);
        $stmt->bindValue(":diets", '%' . $diets . '%');
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function getRecipesByName($name, $username) {
        $dbh = DBInit::getInstance();

        /*
        $diets = RecipeDB::getDiets($username);
        $diets = $diets[0]["diets"];
        $dietsArr = explode(",", $diets);
        $dietsArr = array_filter($dietsArr);
        $dietsArr = array_values($dietsArr);
        $diet1 = $diet2 = $diet3 = $diet4 = "''";

        if (in_array("Vegan", $dietsArr)) {
            $diet1="Vegan";
        }
        if (in_array("Pescetarian", $dietsArr)) {
            $diet2="Pescetarian";
        }
        if (in_array("Ketogenic", $dietsArr)) {
            $diet3="Ketogenic";
        }
        if (in_array("Vegetarain", $dietsArr)) {
            $diet4="Vegetarian";
        }
        */

        $query = "SELECT * FROM recipes WHERE name LIKE :cond";
        $stmt = $dbh->prepare($query);
        $stmt->bindValue(":cond", '%' . $name . '%');
        /*
        $stmt->bindValue(":diet1", '%' . $diet1 . '%');
        $stmt->bindValue(":diet2", '%' . $diet2 . '%');
        $stmt->bindValue(":diet3", '%' . $diet3 . '%');
        $stmt->bindValue(":diet4", '%' . $diet4 . '%');
        */
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function getDiets($name) {
        $dbh = DBInit::getInstance();

        $query = "SELECT diets FROM userInfo WHERE username=:name";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function addRecipe($author, $ingredients, $instructions, $diets, $name) {
        $dbh = DBInit::getInstance();

        $query = "INSERT INTO recipes (user, ingredients, instructions, diets, name) VALUES (:user, :ingredients, :instructions, :diets, :name)";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(":user", $author);
        $stmt->bindParam(":ingredients", $ingredients);
        $stmt->bindParam(":instructions", $instructions);
        $stmt->bindParam(":diets", $diets);
        $stmt->bindParam(":name", $name);
        $stmt->execute();
    }

    public static function getRecipeById($id) {
        $dbh = DBInit::getInstance();

        $query = "SELECT * FROM recipes WHERE id=:id";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function getRecipesByAuthor($author) {
        $dbh = DBInit::getInstance();

        $query = "SELECT * FROM recipes WHERE user=:author";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(":author", $author);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function getRecipesForDiets($username){
        $dbh = DBInit::getInstance();

        $diets = RecipeDB::getDiets($username);
        $diets = $diets[0]["diets"];
        $dietsArr = explode(",", $diets);
        $dietsArr = array_filter($dietsArr);
        $dietsArr = array_values($dietsArr);
        $diet1 = $diet2 = $diet3 = $diet4 = "''";

        if (in_array("Vegan", $dietsArr)) {
            $diet1="Vegan";
        }
        if (in_array("Pescetarian", $dietsArr)) {
            $diet2="Pescetarian";
        }
        if (in_array("Ketogenic", $dietsArr)) {
            $diet3="Ketogenic";
        }
        if (in_array("Vegetarain", $dietsArr)) {
            $diet4="Vegetarian";
        }

        $query = "SELECT * FROM recipes WHERE diets LIKE :diet1 OR diets LIKE :diet2 OR diets LIKE :diet3 OR diets LIKE :diet4";
        $stmt = $dbh->prepare($query);
        $stmt->bindValue(":diet1", '%' . $diet1 . '%');
        $stmt->bindValue(":diet2", '%' . $diet2 . '%');
        $stmt->bindValue(":diet3", '%' . $diet3 . '%');
        $stmt->bindValue(":diet4", '%' . $diet4 . '%');
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function editRecipe($id, $ingredients, $instructions, $diets, $name) {
        $dbh = DBInit::getInstance();

        $query = "UPDATE recipes SET ingredients=:ingredients, instructions=:instructions, diets=:diets, name=:name WHERE id=:id";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":ingredients", $ingredients);
        $stmt->bindParam(":instructions", $instructions);
        $stmt->bindParam(":diets", $diets);
        $stmt->bindParam(":name", $name);
        $stmt->execute();
    }

    public static function getId() {
        $dbh = DBInit::getInstance();

        $query = "SELECT MAX(id) FROM recipes";
        $stmt = $dbh->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll()[0]["MAX(id)"];
    }

    public static function setPic($pic, $id) {
        $dbh = DBInit::getInstance();

        $query = "UPDATE recipes SET picture=:pic WHERE id=:id";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":pic", $pic);
        $stmt->execute();
    }
}