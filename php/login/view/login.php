<?php
if (isset($_GET['redirect'])) {
    $redirect = $_GET['redirect'];
}
session_start();
require_once "../../vendor/autoload.php";
//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('1042968621215-5h6voj4amt32hmddcsmpfbpr2o3k8tpa.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('TXf0qO4MoOa1M9a3G6gFsPja');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost:8080/login/view/login.php');

//
$google_client->addScope('email');

$google_client->addScope('profile');


$login_button = '';

//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if (isset($_GET["code"])) {
    //It will Attempt to exchange a code for an valid authentication token.
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
    if (!isset($token['error'])) {
        //Set the access token used for requests
        $google_client->setAccessToken($token['access_token']);

        //Store "access_token" value in $_SESSION variable for future use.
        $_SESSION['access_token'] = $token['access_token'];

        //Create Object of Google Service OAuth 2 class
        $google_service = new Google_Service_Oauth2($google_client);

        //Get user profile data from google
        $data = $google_service->userinfo->get();

        //Below you can find Get profile data and store into $_SESSION variable
        if (!empty($data['given_name'])) {
            $_SESSION['user_first_name'] = $data['given_name'];
        }
        if (!empty($data['id'])) {
            $_SESSION['id'] = $data['id'];

        }

        if (!empty($data['family_name'])) {
            $_SESSION['user_last_name'] = $data['family_name'];
        }

        if (!empty($data['email'])) {
            $_SESSION['user_email_address'] = $data['email'];
        }

        if (!empty($data['gender'])) {
            $_SESSION['user_gender'] = $data['gender'];
        }

        if (!empty($data['picture'])) {
            $_SESSION['user_image'] = $data['picture'];
        }
        $_SESSION['google'] = true;
        require_once "../../user/User.php";
        $user = new User();
        $user->googleUser($data['email'], $data['id'], $data['given_name'], $data['family_name'], $data['picture']);
    }


}

//This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.
if (!isset($_SESSION['access_token'])) {
    //Create a URL to obtain user authorization
    $login_button = '<a href="' . $google_client->createAuthUrl() . '"><img style="height: 50px; width: 200px; " src="sign-in-with-google.png"  alt="sign in with google"/></a>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8"
        crossorigin="anonymous"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="../../resources/city-of-hayward-squarelogo-1465473393255.png"
                                              style="height: 50px; width: 50px" alt="city of hayward logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="index.php">Home</a>
                </li>
                <?php
                if (!isset($id)) {
                    echo '<li class="nav-item">
          <a class="nav-link" href="createaccount.php">Create Account</a>
        </li>';
                    echo '<li class="nav-item">
          <a class="nav-link active" href="login.php">Login</a>
        </li>';

                } else {
                    include "user/User.php";
                    $user = new User();
                    if (!$user->getDefaults($_SESSION['id'])) {
                        header("LOCATION: tags/tags.php?newuser=true");
                    } else {

                        echo '<li class="nav-item">
          <a class="nav-link" href="tags/tags.php">Event Types</a>
        </li>';
                        echo '<li class="nav-item">
<a class="nav-link" href="login/logout.php">Logout</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="settings.php">Settings</a></li>';
                    }
                }
                ?>
            </ul>

        </div>
    </div>
</nav>
<form action="../loginUser.php" method="post">
    <input type="hidden" name="redirect" value="<?php
    if (isset($redirect)) {
        echo $redirect;
    } else {
        echo "none";
    } ?>">
    <div class="mb-3">
        <label class="form-label" for="email">Email</label>
        <input id="email" name="email" type="email" required="required">
    </div>
    <div class="mb-3">
        <label class="form-label" for="password">Password</label>
        <input id="password" type="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<div class="panel panel-default">
    <?php

    echo '<div>' . $login_button . '</div>';
    ?>
</div>

</body>
</html>