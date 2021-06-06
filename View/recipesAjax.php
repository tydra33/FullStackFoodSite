<!DOCTYPE html>

<link rel="stylesheet" href="<?= CSS_URL . "recipesPage.css" ?>">
<head>
<style>
    html {
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
<title>AJAX Recipe search</title>

<h1>Recipes</h1>

<label>Search: <input id="search-field" type="text" name="query" autocomplete="off" autofocus pattern="[a-zA-Z0-9 ()]+" /></label>
<ul id="recipe-hits"></ul>

<form action="<?= htmlspecialchars("addRecipe", ENT_QUOTES, 'UTF-8') ?>" method="get">
    <input type="submit" value="Add Recipe" formmethod="get">
</form>

<form action="<?= htmlspecialchars("userPage", ENT_QUOTES, 'UTF-8') ?>" method="get">
    <input type="hidden" readonly name="author" value="<?= $_SESSION["username"] ?>"></input><br>
    <input type="submit" value="My Page" formmethod="get">
</form>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function () {
    $("#search-field").keyup(function () {
        const url = "<?= BASE_URL . "recipePage" ?>";
        $.get(url,
            {
                query : $(this).val()
            },
            function(data) {
                $("#recipe-hits").empty();
                try {
                    data = JSON.parse(data);
                }
                catch (ignored) {}
                for(recipe of data) {
                    let item = `<li><a href= <?= BASE_URL?>recipe?id=(${recipe.id})>(${recipe.name})</a></li>`;
                    $("#recipe-hits").append(item);
                }
            }
        );
    });
});
</script>