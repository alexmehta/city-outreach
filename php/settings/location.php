<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Location</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<form method="post" action="db/location.php">

    <fieldset>
        <!-- Address form -->

        <h1>Address</h1>

        <!-- address-line1 input-->
        <div class="control-group">
            <label class="control-label">Address Line 1</label>
            <div class="controls">
                <input id="address-line1" name="address-line1" type="text" placeholder="address line 1"
                       class="input-xlarge">
                <p class="help-block">Street address, P.O. box, company name, c/o</p>
            </div>
        </div>
        <!-- address-line2 input-->
        <div class="control-group">
            <label class="control-label">Address Line 2</label>
            <div class="controls">
                <input id="address-line2" name="address-line2" type="text" placeholder="address line 2"
                       class="input-xlarge">
                <p class="help-block">Apartment, suite , unit, building, floor, etc.</p>
            </div>
        </div>
        <!-- city input-->
        <div class="control-group">
            <label class="control-label">City / Town</label>
            <div class="controls">
                <input id="city" name="city" type="text" placeholder="city" class="input-xlarge">
                <p class="help-block"></p>
            </div>
        </div>
        <!-- region input-->
        <div class="control-group">
            <label class="control-label">State / Province / Region</label>
            <div class="controls">
                <input id="region" name="region" type="text" placeholder="state / province / region"
                       class="input-xlarge">
                <p class="help-block"></p>
            </div>
        </div>
        <!-- postal-code input-->
        <div class="control-group">
            <label class="control-label">Zip / Postal Code</label>
            <div class="controls">
                <input id="postal-code" name="postal-code" type="text" placeholder="zip or postal code"
                       class="input-xlarge">
                <p class="help-block"></p>
            </div>
        </div>
    <input aria-label="submit" placeholder="submit" name="submit" value="submit" type="submit">
    </fieldset>

</form>
</body>
</html>
