<?php


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
        $stmt = ("SELECT * FROM upcomingevents WHERE tag in (SELECT tags FROM listtags WHERE listtags.id in (SELECT tag from following WHERE userid=?))");
        $stmt = $pdo->prepare($stmt);
        $stmt->execute([$_SESSION['id']]);
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