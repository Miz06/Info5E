<?php

session_start();
require '../references/functions.php';
require '../connectionToDB/DBconn.php';

$_SESSION['config'] = require '../connectionToDB/databaseConfig.php';
$config = $_SESSION['config'];
$db = DBconn::getDB($config);

$queryNomeUtente = 'SELECT nome FROM db_FastRoute.personale WHERE email = :email';

if (isset($_SESSION['email']) && ($_SESSION['email'] != 'Ospite')) {
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .account {
            border: 1px solid white;
            padding: 1%;
            margin: 1%;
            border-radius: 5px;
            color: white;
            background-color: darkgreen;
        }

        .nav-link {
            border: 1px solid white;
            border-radius: 5px;
            color: white;
            text-align: center;
        }

        .private {
            background-color: darkslateblue;
        }

        .nav-link:hover {
            background-color: grey;
        }

        .account:hover {
            background-color: forestgreen;
        }
    </style>
</head>

<body class="p-3 border-0 bd-example m-0 border-0" style="background-color: whitesmoke">

<?php if (isset($_COOKIE['nav_color'])) { ?>
<nav class="navbar navbar-expand-lg navbar-dark mb-3"
     style="background-color: <?= $_COOKIE['nav_color'] ?>; border-radius: 15px;">
    <?php }else{ ?>
    <nav class="navbar navbar-expand-lg navbar-dark mb-3" style="background-color: black; border-radius: 15px;">
        <?php } ?>
        <div class="container-fluid">
            <a class="navbar-brand account" href="./account.php"> <?= $nomeUtente ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item m-2">
                        <a class="nav-link active" aria-current="page"
                           href="./home.php">Home</a>
                    </li>
                    <li class="nav-item m-2">
                        <a class="nav-link active" aria-current="page"
                           href="../pages/login.php">Login</a>
                    </li>
                    <li class="nav-item m-2">
                        <a class="nav-link active" aria-current="page"
                           href="../pages/info.php">Info</a>
                    </li>
                    <?php if (isset($_SESSION['email']) && $_SESSION['email'] != 'Ospite') { ?>
                        <li class="nav-item m-2">
                            <a class="nav-link active private" aria-current="page" href="./registra_cliente.php">Registra
                                cliente</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link active private" aria-current="page" href="./nuovo_plico.php">Nuovo plico</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>