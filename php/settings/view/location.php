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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<form style="padding: 10px" method="post" action="../db/location.php">

    <!-- Address form -->

    <h1>Address</h1>

    <!-- address-line1 input-->
    <div class="form-group">
        <label class="control-label">Address Line 1</label>
        <div class="controls">
            <input id="address-line1" name="address-line1" type="text" placeholder="address line 1"
                   class="input-xlarge">
            <p class="help-block">Street address, P.O. box, company name, c/o</p>
        </div>
    </div>
    <!-- address-line2 input-->
    <div class="form-group">
        <label >Address Line 2</label>
        <div class="controls">
            <input id="address-line2" name="address-line2" type="text" placeholder="address line 2"
                   >
            <p class="help-block">Apartment, suite , unit, building, floor, etc.</p>
        </div>
    </div>
    <!-- city input-->
    <div class="form-group">
        <label class="control-label">City / Town</label>
        <div class="controls">
            <input id="city" name="city" type="text" placeholder="city" class="input-xlarge">
            <p class="help-block"></p>
        </div>
    </div>
    <!-- region input-->
    <div class="form-group">
        <label class="control-label">State / Province / Region</label>
        <div>
            <input id="region" name="region" type="text" placeholder="state / province / region"
                   class="input-xlarge">
            <p class="help-block"></p>
        </div>
    </div>
    <!-- postal-code input-->
    <div class="form-group">
        <label class="control-label">Zip / Postal Code</label>
        <div class="controls">
            <input id="postal-code" name="postal-code" type="text" placeholder="zip or postal code"
                   class="input-xlarge">
            <p class="help-block"></p>
        </div>
    </div>
    <input aria-label="submit" placeholder="submit" name="submit" value="submit" type="submit">

</form>
</body>
</html>
