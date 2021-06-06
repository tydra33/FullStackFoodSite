<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write recipe</title>

    <style>
        p, form {
            backdrop-filter: blur(5px);
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
        <h1>Add New Recipe:</h1>
        <p>NOTE: you may add an image in the edit section</p>
        <form action="<?= htmlspecialchars("addRecipe", ENT_QUOTES, 'UTF-8') ?>" method="post">
            <p>Title: </p>
            <textarea name="name" class="smaller"></textarea> <br>
            <p>Ingedients: </p>
            <textarea name="ingredients"></textarea>
            <p>Instructions: </p>
            <textarea name="instructions"></textarea> <br>
            <p>Diets: </p>
            <textarea name="diets" class="smaller"></textarea> <br>
            <input type="submit" value="Submit" formmethod="post">
        </form>
    </div>
</body>

</html>