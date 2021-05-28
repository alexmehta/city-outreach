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
            <th>Follow Event</th>
        </tr>
        </thead>
        <tbody>
        <?php
        include "includes/includes.php";
        ini_set('display_errors', 1);
        $stmt = ("SELECT * FROM upcomingevents WHERE tag in (SELECT tags FROM listtags WHERE listtags.id in (SELECT tag from following WHERE userid=?))");
        $stmt = $pdo->prepare($stmt);
        $stmt->execute([$_SESSION['id']]);
        //fetches all user intrest roles
        if ($stmt->rowCount() == 0) {
            echo "Check to see if you have no interests listed";
        }
        while ($row = $stmt->fetch()):?>
            <?php
            //checks if it is upcoming based on unix time (converts first from sql string)
            $dtime = DateTime::createFromFormat("m/d/Y h:i A", $row['date'] . " " . $row['time']);

            try {
                $dt = new DateTime("now", new DateTimeZone('America/Phoenix'));
            } catch (Exception $e) {
                //echo $e;
            }
            if ($row['name'] == "Council Sustainability Committee") {
                //echo $dt->getTimestamp();
                //echo "<br>";
                //echo $dtime->getTimestamp();
            }


            if ($dtime->getTimestamp() > $dt->getTimestamp()):

                ?>
                <tr>
                    <td>
                        <a href="/event/view/event.php?id=<?php echo $row['id'] ?>"><?php echo $row['name']; ?></a>

                    </td>
                    <td><?php echo $row['date'] ?></td>
                    <td>
                        <?php echo $row['time']; ?>
                    </td>
                    <td><?php echo $row['tag'] ?></td>
                    <td>
                        <?php
                        $sql = "SELECT * FROM meetingminutes WHERE event=?";
                        $stmt2 = $pdo->prepare($sql);
                        $stmt2->execute([$row['id']]);
                        $s = [];
                        $index = 0;


                        while ($row2 = $stmt2->fetch()):?>
                            <?php
                            $s[$index] = $row2['tag'];
                            $index++;
                            ?>

                        <?php endwhile; ?>
                        <?php
                        foreach ($s as $item) {
                            if (!array_key_exists($item, $s)) {
                                echo $item . " ";
                                $s[$item] = true;
                            }
                        }

                        ?>
                    </td>
                    <?php
                    include_once "notifications/Notifications.php";
                    $notification = new Notifications();
                    if ($notification->getNotification($row['id'], $_SESSION['id']) == 0):?>
                        <td><a href="../notifications/view/addReminder.php?id=<?php echo $row['id']; ?>">Follow</a></td>
                    <?php endif; ?>
                    <?php
                    if ($notification->getNotification($row['id'], $_SESSION['id']) != 0):
                        ?>
                        <td><a href="../notifications/removeReminder.php?id=<?php echo $row['id']; ?>">Unfollow</a></td>
                    <?php endif; ?>
                </tr>
            <?php endif ?>
        <?php endwhile; ?>
        </tbody>
    </table>
<?php endif;


?>