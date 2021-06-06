<!DOCTYPE html>
<html lang="en">

<?php
    require_once("Controller/recipeController.php");
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit recipe</title>
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
    <?php
        if(!isset($_GET["id"])) {
            die("Invalid request");
        }
    ?>

    <div class="loginBox">
        <h1>Recipe Details:</h1>

        <form action="<?= htmlspecialchars("upload", ENT_QUOTES, 'UTF-8') ?>" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="hidden" name="id" value=<?= htmlspecialchars($_GET["id"], ENT_QUOTES, 'UTF-8') ?>>
            <input type="submit" value="Upload Image" name="submit">
        </form>
        
        <form action='<?= htmlspecialchars("changeRecipe", ENT_QUOTES, 'UTF-8') ?>' method="post">
            <p>Recipe ID: </p>
            <textarea name="id" id="id" class="smaller" readonly><?= htmlspecialchars($_GET["id"], ENT_QUOTES, 'UTF-8') ?></textarea>
            <p>Title: </p>
            <textarea class="smaller" name="name" id="title"></textarea> <br>
            <p>Ingedients: </p>
            <textarea id="ingredients" name="ingredients"></textarea>
            <p>Instructions: </p>
            <textarea id="instructions" name="instructions"></textarea> <br>
            <p>Diets: </p>
            <textarea class="smaller" id="diets" name="diets"></textarea> <br>
            <input type="submit" value="Submit Changes" formmethod="post">
        </form>

        <form action="<?= htmlspecialchars("home", ENT_QUOTES, 'UTF-8') ?>" method="get">
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
                
                $("#title").html(title);
                $("#diets").html(diets);
                $("#ingredients").html(ingredients);
                $("#instructions").html(instructions);
            });
        </script>
    </div>
</body>

</html>