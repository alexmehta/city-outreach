<?php
ini_set('display_errors', 0);
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=0.5">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tags</title>
</head>
<body>
<h1>Tags</h1>
<ul>
    <?php
    include "../../includes/includes.php";

    if (isset($_GET['newuser'])&&isset($_SESSION['id'])){
        echo "<h2>Add your intrests by following tags </h2>";
        include "../../user/User.php";
        $user = new User();
        $user->changeDefaults($_SESSION['id']);
    }
    echo '<a href="../../index.php">Go back to home</a>';
    $stmt = $pdo->query("SELECT * FROM listtags");
    while ($row = $stmt->fetch()):?>

    <?php
        $sql = "SELECT * FROM following where tag = ? and userid = ?";
        $sql  = $pdo->prepare($sql);
        $sql->execute([$row['id'], $_SESSION['id']]);
        $sql = $sql->fetch();
        if (!$sql){
            $var = "follow";
        }
        else{
            $var = "unfollow";
        }

        ?>

        <li>
            <?php echo $row['tags']; ?> - <a href="<?php echo "controller/" . $var . ".php?id=" . $row['id'] ?>">

                <?php
                echo $var;
                ?>

            </a>
        </li>

    <?php endwhile; ?>
</ul>

</body>
</html>
