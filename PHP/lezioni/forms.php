<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="myStyle.css">
    <title>Document</title>
</head>
<body>
<h2>PHP Form validation with main controllers</h2>


<form method="post" action="display.php">
    <label for="name">Enter your name:</label>
    <br>
    <input type="text" id="name" value="your name">
    <br>
    <br>


    <label for="pwd">Enter your password:</label>
    <br>
    <input type="password" id="pwd" name="pwd">
    <br>
    <br>


    <!-- TEXT AREA -->
    <label for="comment">Enter your comment:</label>
    <br>
    <textarea id="comment" name="comment" rows="5" cols="40"></textarea>
    <br>
    <br>


    <!-- RADIO BUTTONS -->
    <br>
    <label for="gender">Enter your gender:</label>
    <input type="radio" id="gender" name="gender" value="female">Female
    <input type="radio" id="gender" name="gender" value="male">Male
    <input type="radio" id="gender" name="gender" value="other">Other
    <br>
    <br>


    <!-- CHECKBOX -->
    <br>
    <label for="top">Toppings:</label>
    <br>
    <input type="checkbox" id="top" name="top[]" value="pen">Pepperoni
    <input type="checkbox" id="top" name="top[]" value="msh"> Mushrooms
    <input type="checkbox" id="top" name="top[]" value="olv">Olives
    <br>
    <br>


    <!--DROP DOWN LIST -->
    <br>
    <label for="car"> Choose a car from the list box : </label>
    <br>
    <select id="car" name="car">
        <option value="Audi">Audi</option>
        <option value="Volvo">Volvo</option>
        <option value="Mercedes">Mercedes</option>
        <option value="Mazda">Mazda</option>
    </select>
    <br>
    <br>


    <!--LIST BOX MULTIPLE SECTION -->
    <br>
    <label for="cars"> Choose a car: </label>
    <br>
    <select id="cars" name="cars[]" size="4" multiple>
        <option value="Audi">Audi</option>
        <option value="Volvo">Volvo</option>
        <option value="Mercedes">Mercedes</option>
        <option value="Mazda">Mazda</option>
    </select>
    <br>
    <br>


    <input type="submit" value="Submit">


</form>


</body>
</html>

