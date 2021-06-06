<!DOCTYPE html>
<html lang="en">

<?php
    require_once("Controller/recipeController.php");
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <style>
        p, form {
            backdrop-filter: blur(7px);
        }

        html {
            min-height: 100%;
            background-image: url(<?= IMAGES_URL . "firstPage.jpg" ?>);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            color: wheat;
        }

        textarea {
            width: 50%;
            height: 150px;
        }

        .smaller {
            width: 50%;
            height: 50px;
        }
    </style>
</head>

<body>
    <div class="loginBox">
        <h1>Recipe Details:</h1>

        <form action="userPage?author=<?= htmlspecialchars(recipeController::getRecipeById(str_replace(array( '(', ')' ), '', $_GET["id"]))[0]["user"]) ?>" method="post">
            <p name="author">Author: <?= htmlspecialchars(recipeController::getRecipeById(str_replace(array( '(', ')' ), '', $_GET["id"]))[0]["user"]) ?></p>
            <input type="submit" value="Go to user's page">
        </form>
        
        <div id="pic"></div>
        <form action="<?= htmlspecialchars("home", ENT_QUOTES, 'UTF-8') ?>" method="get">
            <p>Title: </p>
            <textarea class="smaller" readonly id="title"></textarea> <br>
            <p>Ingedients: </p>
            <textarea readonly id="ingredients"></textarea>
            <p>Instructions: </p>
            <textarea readonly id="instructions"></textarea> <br>
            <p>Diets: </p>
            <textarea class="smaller" readonly id="diets"></textarea> <br>
            <input type="submit" value="Home" formmethod="get">
        </form>

        <script>
            $(document).ready(() => {
                let title =
                <?= json_encode(htmlspecialchars(recipeController::getRecipeById(str_replace(array( '(', ')' ), '', $_GET["id"]))[0]["name"], ENT_QUOTES, 'UTF-8')) ?>;
                let diets = 
                <?= json_encode(htmlspecialchars(recipeController::getRecipeById(str_replace(array( '(', ')' ), '', $_GET["id"]))[0]["diets"], ENT_QUOTES, 'UTF-8')) ?>;
                let ingredients = 
                <?= json_encode(htmlspecialchars(recipeController::getRecipeById(str_replace(array( '(', ')' ), '', $_GET["id"]))[0]["ingredients"], ENT_QUOTES, 'UTF-8')) ?>;
                let instructions = 
                <?= json_encode(htmlspecialchars(recipeController::getRecipeById(str_replace(array( '(', ')' ), '', $_GET["id"]))[0]["instructions"], ENT_QUOTES, 'UTF-8')) ?>;
                let pic = `<?= PICS_URL ?>` + 
                <?= json_encode(htmlspecialchars(recipeController::getRecipeById(str_replace(array( '(', ')' ), '', $_GET["id"]))[0]["picture"], ENT_QUOTES, 'UTF-8')) ?>;

                $("#title").html(title);
                $("#diets").html(diets);
                $("#ingredients").html(ingredients);
                $("#instructions").html(instructions);

                let item = `<img width=200 height=200 src="` + pic + `">`;
                console.log(item);
                $("#pic").append(item);
            });
        </script>
    </div>
</body>

</html>