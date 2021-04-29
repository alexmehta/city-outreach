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
</head>
<body>
<p>Location</p>

<form>

    <fieldset>
        <!-- Address form -->

        <h2>Address</h2>

        <!-- full-name input-->
        <div class="control-group">
            <label class="control-label">Full Name</label>
            <div class="controls">
                <input id="full-name" name="full-name" type="text" placeholder="full name"
                       class="input-xlarge">
                <p class="help-block"></p>
            </div>
        </div>
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
      <label>Submit</label>  <input aria-label="submit" placeholder="submit" name="submit" value="submit" type="submit">
    </fieldset>

</form>
</body>
</html>
