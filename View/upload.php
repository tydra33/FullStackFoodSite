<!DOCTYPE html>
<html>
<body>

<style>
        p {
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

<?php
    require_once("model/RecipeDB.php");

    $target_dir = "Static/pics/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if(!isset($_FILES["fileToUpload"]["tmp_name"]) || empty($_FILES["fileToUpload"]["tmp_name"])) {
        die("Please select file");
    }

// Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".\n";
            $uploadOk = 1;
        } else {
            echo "File is not an image.\n";
            $uploadOk = 0;
        }
    }

// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.\n";
        $uploadOk = 0;
    }

// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.\n";
        $uploadOk = 0;
    }

// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.\n";
        $uploadOk = 0;
    }

// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . pathinfo($target_file, PATHINFO_FILENAME))) {
            RecipeDB::setPic(pathinfo($target_file, PATHINFO_FILENAME), (str_replace(array( '(', ')' ), '', $_POST["id"]))[0]);

            echo "The file ". pathinfo($target_file, PATHINFO_FILENAME) . " has been uploaded.\n";
        } else {
            echo "Sorry, there was an error uploading your file.\n";
        }
    }
?>

<form action="<?= htmlspecialchars("home", ENT_QUOTES, 'UTF-8') ?>" method="get">
            <input type="submit" value="Home" formmethod="get">
</form>

</body>
</html>