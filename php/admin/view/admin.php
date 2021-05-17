<?php
    ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        Expand graph
    </a>

<div class="container">
    <div class="row">
        <div class="col"
            >
            <div class="collapse " id="collapseExample">
                <div class="">
                    <canvas  id="myChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col">
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
                include "../../includes/includes.php";
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
        </div>
    </div>


</div>

<script>
    const data = {
        labels: [
            'Red',
            'Blue',
            'Yellow'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [300, 50, 100],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };
    const config = {
        type: 'doughnut',
        data,
        options: {}
    };

    var chart = new Chart(document.getElementById("myChart"),config);
</script>



</body>
</html>
