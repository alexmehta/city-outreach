<?php
include "../../includes/csrf.php";
if (isset($_GET['redirect'])) {
    $redirect = $_GET['redirect'];
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
    <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
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
</body>
</html>