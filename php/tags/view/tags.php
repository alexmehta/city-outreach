<?php
ob_start();
session_start();
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=0.5">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tags</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8"
        crossorigin="anonymous"></script>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="../resources/city-of-hayward-squarelogo-1465473393255.png"
                                                  style="height: 50px; width: 50px" alt="city of hayward logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                    <li>
                        <ul>
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="../notifications/notifications.php">Notifications</a>
                                <li>
                                    <ul>
            </div>
        </div>
    </nav>

</header>

<ul class="list-group ">
    <?php
    include "../../includes/includes.php";

    if (isset($_GET['newuser']) && isset($_SESSION['id'])) {
        echo "<h2>Add your intrests by following tags </h2>";
        include "../../user/User.php";
        $user = new User();
        $user->changeDefaults($_SESSION['id']);
    }
    $stmt = $pdo->query("SELECT * FROM listtags");
    while ($row = $stmt->fetch()):?>

        <?php
        $sql = "SELECT * FROM following where tag = ? and userid = ?";
        $sql = $pdo->prepare($sql);
        $sql->execute([$row['id'], $_SESSION['id']]);
        $sql = $sql->fetch();
        if (!$sql) {
            $var = "follow";
        } else {
            $var = "unfollow";
        }

        ?>

        <li class="list-group-item list-group-item-action">
            <div class="fw-bold"><?php echo $row['tags']; ?></div>
            <span class="badge bg-primary rounded-pill" style="color: white"><a style="color: white;"
                                                                                href="<?php echo "controller/" . $var . ".php?id=" . $row['id'] ?>"><?php echo $var; ?></a></span>
        </li>
    <?php endwhile; ?>

</ul>

</body>
</html>
