<?php
$events = new Events();
$events = $events->getCurrentDetails($row['id']);
//todo select tags instead
//todo create tag creator with similarity detection
?>
<input type="hidden" name="id" value="<?php
echo $events['id'];
?>">
<label for="event">Event Name</label>
<input id="event" type="text" name="name" value="<?php echo $events['name']; ?>">
<label for="date">Date</label>
<input id="date" type="text" name="date" value="<?php echo $events['date']; ?>">
<label for="time">Time</label>
<input id="time" type="text" name="time" value="<?php echo $events['time']; ?>">
<label for="location">Location</label>
<input type="text" id="location" name="location" value="<?php echo $events['location']; ?>">

<label for="tag">Tag</label>
<select name="tag" id="tag">
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/database.php";
    $database = new database();
    $pdo = $database->connect();
    $sql = "SELECT * FROM listtags";
    $sql = $pdo->prepare($sql);
    $sql->execute([]);
    while($row = $sql->fetch()):

        ?>
        <option value="<?php echo $row['tags']?>"><?php echo $row['tags']?></option>

    <?php endwhile;?>
    <option onclick="window.open('newtag.php','_Blank','widht=500px,height=500px')">Create new Tag</option>

</select>




