<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <style>
    html {
        min-height: 100%;
        background-image: url(<?= IMAGES_URL . "firstPage.jpg" ?>);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
    }

    .loginBox {
        width: 40%;
        height: 50%;
        backdrop-filter: blur(7px);
        top: 30%;
        left: 30%;
        position: absolute;
        box-sizing: border-box;
        color: wheat;
        text-align: center;
    }

    .loginBox p {
        font-weight: bold;
    }

    .loginBox input {
        width: 80%;
        margin-bottom: 20px;
    }

    .loginBox input[type="text"], input[type="password"] {
        border: none;
        border-bottom: 1px solid wheat;
        background: transparent;
        outline: none;
        color: wheat;
    }

    .loginBox input[type="submit"] {
        border: none;
        outline: none;
        background: wheat;
        border-radius: 20px;
        width: 30%;
    }

    .loginBox input[type="submit"]:hover {
        cursor: pointer;
    }

    .loginBox a {
        text-decoration: none;
        color: wheat;
    }

    .error {
        color: red;
        background: black;
    }

    @media only screen and (min-width: 1000px) {
        .loginBox input {
            width: 60%;
        }    
    }
    </style>

</head>

<body>
    <div class="loginBox">
        <h1>User Sign Up:</h1>
        <form action="<?= htmlspecialchars(BASE_URL . "createAccount", ENT_QUOTES, 'UTF-8') ?>" method="post" onsubmit="return validateMyForm();">
            <p>Username: </p>
            <input type="text" name="username" placeholder="Enter New Username" pattern="[a-zA-Z0-9 ]+" required>
            <p>Password: </p>
            <input type="password" name="password1" id="password1" placeholder="Enter New Password" pattern="[a-zA-Z0-9 ]+" required> <br>
            <input type="password" name="password2" id="password2" placeholder="Confirm Password" pattern="[a-zA-Z0-9 ]+" required> <br>
            <input type="submit" name="signUpBtn" value="Sign Up"> <br>
        </form>

        <?php
            if (isset($_SESSION["error1"]) && $_SESSION["error1"] == TRUE) { ?>
                <div>
                    <p class="error">Username already exists</p>
                </div>
        <?php
                $_SESSION["error1"] = FALSE;
            }
        ?>

    </div>
</body>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
    function validateMyForm() {
        if ($('#password1').val() != $('#password2').val()) {
            alert("Passwords do not match!")
        }
        return $('#password1').val() == $('#password2').val();
    }
</script>

</html>