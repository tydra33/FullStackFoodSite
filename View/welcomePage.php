<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>

    <link rel="stylesheet" href= "<?= CSS_URL . "homePage.css" ?>">
    <style>
        html {
            min-height: 100%;
            background-image: url(<?= IMAGES_URL . "homePage.jpg" ?>);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
        }
    </style>
</head>

<body>
    <h1 id="title">Welcome!</h1>

    <div id="select">
        <form action="addEntry" method="post">
            <p>Select diets:</p>
            <input type="checkbox" id="vegan" name="vegan"> Vegan <br>
            <input type="checkbox" id="pescetarian" name="pescetarian"> Pescetarian <br>
            <input type="checkbox" id="ketogenic" name="ketogenic"> Ketogenic <br>
            <input type="checkbox" id="vegetarain" name="vegetarain"> Vegetarain <br>
            <input type="hidden" name="username" val=<?= $_SESSION["username"] ?>>
            <input type="submit">
        </form>
    </div>
</body>

</html>