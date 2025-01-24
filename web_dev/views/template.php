<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="mystyle.css">
    <title>Views</title>
</head>
<body>
    <div class="topnav">
        <a href="home.php">Home</a>
        <a href="news.php">News</a>
        <a href="contact.php">Contact</a>
        <a href="about.php">About</a>
    </div>
    <div>
        <p>Buongiorno</p>
        <p><?=/**@var $content*/$content?></p> <!-- modo 1 di scrivere-->
        <!-- /**@var $content*/  contente di specificare il fatto che la variabile content giunge dall'esterno del file -->
        <p><?php echo $content?></p> <!-- modo 2 di scrivere-->
    </div>
    <div class="footer">
        <p>website&copy5Einformatica</p>
    </div>
</body>
</html>