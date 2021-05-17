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
            <?php
            $dt = new DateTime("now", new DateTimeZone('America/Phoenix'));
            $time = strtotime($row['date']);
            if ($time > strtotime($dt->format("m/d/Y, H:i:s"))):
                ?>
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
                    $s = [];
                    $index = 0;


                    while ($row2 = $stmt2->fetch()):?>
                        <?php
                        $s[$index] = $row2['tag'];
                        $index++;
                        ?>

                    <?php endwhile;?>
                    <?php
                        foreach ($s as $item){
                            if (!array_key_exists($item, $s)){
                                echo $item . " ";
                                $s[$item] = true;
                            }
                        }

                    ?>
                </td>
            </tr>
            <?php endif?>
        <?php endwhile;?>
        </tbody>
    </table>
<?php endif; ?>