<?php
$event = $_GET['event'];
$meetingminute = $_GET['tagid'];
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

</head>
<body>


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>
<h1>Send a message:</h1>
<form class="form-control">
    <label for="event">Event</label>
    <input id="event" type="text" disabled="disabled" name="event" value="<?php echo $event ?>">
    <label for="event">Event Item</label>
    <input id="event" type="text" disabled="disabled" name="event" value="<?php echo $meetingminute ?>">
    <label for="message">Subject</label>
    <input type="text" id="subject" name="subject">
    <label for="message">Message</label>
    <input type="text" id="message" name="message">
    <button>Submit</button>
</form>

</body>
</html>
