<!DOCTYPE html>

<?php
    require_once("Controller/recipeController.php");
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<link rel="stylesheet" href="<?= CSS_URL . "recipesPage.css" ?>">
<head>
<style>
    html {
        color: wheat;
        min-height: 100%;
        background-image: url(<?= IMAGES_URL . "homePage.jpg" ?>);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
    }

    h1 {
        color: wheat;
    }
</style>

</head>
<meta charset="UTF-8" />
<title>User Profile</title>

<h1><?= htmlspecialchars($_GET["author"], ENT_QUOTES, 'UTF-8') ?>'s Page</h1>
<?php if ($_GET["author"] == $_SESSION["username"]) { ?>
    <p id="self">This is your page</p>
<?php } ?>

<p id="diets"></p>
<ul id="recipe-hits"></ul>

<form action="<?= htmlspecialchars("home", ENT_QUOTES, 'UTF-8') ?>" method="get">
    <input type="submit" value="Home">
</form>

<script type="text/javascript">
    var str = `<?= json_encode(recipeController::getRecipesByAuthor($_GET["author"])) ?>`;
    str=str.replace(/\n/g, "\\n").replace(/\r/g, "\\r").replace(/\t/g, "\\t");

    var data = JSON.parse(str);
    for(recipe of data) {
        if($("#self").length == 0) {
            let item = `<li><a href= <?= BASE_URL?>recipe?id=(${recipe.id})>(${recipe.name})</a></li>`;
            $("#recipe-hits").append(item);
        } else {
            let item = `<li><a href= <?= BASE_URL?>changeRecipe?id=(${recipe.id})>(${recipe.name})</a></li>`;
            $("#recipe-hits").append(item);
        }
    }

    $("#diets").html("Your preferred diets are: <?= RecipeDB::getDiets("vegan lover")[0]["diets"] ?>");
</script>