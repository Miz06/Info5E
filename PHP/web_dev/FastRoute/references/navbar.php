<?php

session_start();
require '../references/functions.php';
require '../connectionToDB/DBconn.php';

$_SESSION['config'] = require '../connectionToDB/databaseConfig.php';
$config = $_SESSION['config'];
$db = DBconn::getDB($config);

$queryNomeUtente = 'SELECT nome FROM db_FastRoute.personale WHERE email = :email';

if (isset($_SESSION['email'])) {
    try {
        $stm = $db->prepare($queryNomeUtente);
        $stm->bindValue(':email', $_SESSION['email']);
        $stm->execute();
        $nomeUtente = $stm->fetchColumn();
    } catch (Exception $e) {
        logError($e);
        $nomeUtente = "Errore";
    }
} else {
    $nomeUtente = "Ospite";
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?= /**@var $title */
        $title ?></title>

    <link href="./style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="p-3 border-0 bd-example m-0 border-0">

<?php if (isset($_COOKIE['nav_color'])) { ?>
    <nav class="navbar navbar-expand-lg navbar-dark mb-3" style="background-color: <?= $_COOKIE['nav_color'] ?>; border-radius: 15px;">
<?php }else{ ?>
    <nav class="navbar navbar-expand-lg navbar-dark mb-3" style="background-color: black; border-radius: 15px;">
<?php } ?>
        <div class="container-fluid">
            <a class="navbar-brand account" href="./account.php"
               style=" border: 1px solid white; padding: 1%; margin: 1%; border-radius: 5px; color: lightgrey;"> <?= $nomeUtente ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" style="color: lightgrey" aria-current="page"
                           href="./home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" style="color: lightgrey" aria-current="page"
                           href="../pages/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" style="color: lightgrey" aria-current="page" href="./home.php">Inserisci
                            cliente</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>