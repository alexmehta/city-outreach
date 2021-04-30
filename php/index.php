<?php
session_start();
if (isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>City of Hayward Connect</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<h1>City of Hayward</h1>
<?php
if (!isset($id)) {
    echo "<a href='login/createaccount.php'>Create Account</a>
    <br>
    <a href= 'login/login.html'>Login</a>";
}else{
    echo "<a href='logout.php'>Logout</a>";
    echo "<br>";
    echo "<a href='settings.php'>Settings</a>";
}

?>
    <?php
        if (isset($id)):



    ?>


    <table class="table" id="upcoming-events">
        <thead>
            <tr>
                <th>
                   Event
                </th>
                <th>Date</th>
                <th>Time</th>
                <th>main tag</th>
                <th>Other events in meeting</th>
            </tr>
        </thead>
        <tbody>
        <?php
        include "includes/includes.php";
        ini_set('display_errors', 1);
        $stmt = $pdo->query("SELECT * FROM upcomingevents");
        while ($row = $stmt->fetch()):?>
        <tr>
           <td>
               <a href="event.php?id=<?php echo $row['id']?>"><?php  echo $row['name'];?></a>

           </td>
            <td><?php echo $row['date']?></td>
            <td>
                <?php echo $row['time'];?>
            </td>
            <td><?php echo $row['tag']?></td>
            <td>
                <?php
                 $sql = "SELECT * FROM meetingminutes WHERE event=?";
                 $stmt2=$pdo->prepare($sql);
                 $stmt2->execute([$row['id']]);

                 while ($row2 = $stmt2->fetch()):?>
                  <?php echo $row2['tag'] . " ";?>

                <?php endwhile;?>
            </td>
        </tr>
        <?php endwhile;?>
        </tbody>
    </table>
        <?php endif; ?>
</body>
</html>
