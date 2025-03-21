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
        $stm->closeCursor();
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
        h4, .lab {
            border-bottom: 2px solid #007bff;
            width: 100%;
            padding-bottom: 1%;
            color: darkblue;
        }

        strong {
            color: black;
        }

        .element {
            background: white;
            padding: 2%;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 2%;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            width: 70%;
        }

        .submit-container {
            display: flex;
            justify-content: center; /* Centra orizzontalmente */
            margin: 10px 0;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        hr {
            border: 1px solid darkblue;
        }

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

        .nav-link:hover {
            background-color: grey;
        }

        .account:hover {
            background-color: forestgreen;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ccc;
        }

        td {
            background-color: #f9f9f9;
        }

        th {
            background-color: #86f1ee;
        }

        .data-box {
            padding: 1%;
            margin: 1%;
        }

        .log-out {
            display: inline-block;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            background-color: red;
            border: 2px solid red;
            color: white;
        }

        .log-out:hover {
            background-color: darkred;
        }
    </style>
</head>

<body class="p-3 border-0 bd-example m-0 border-0" style="background-color: whitesmoke">

<?php if (isset($_COOKIE['nav_color'])) { ?>
<nav class="navbar navbar-expand-lg navbar-dark"
     style="background-color: <?= $_COOKIE['nav_color'] ?>; border-radius: 15px;">
    <?php }else{ ?>
    <nav class="navbar navbar-expand-lg navbar-dark mb-3" style="background-color: black; border-radius: 15px;">
        <?php } ?>
        <div class="container-fluid">
            <a class="navbar-brand account" href="../pages/account.php"><?=$nomeUtente?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item m-2">
                        <a class="nav-link active" aria-current="page"
                           href="../pages/home.php">Home</a>
                    </li>
                    <?php if (!isset($_SESSION['email']) || $_SESSION['email'] == 'Ospite') { ?>
                    <li class="nav-item m-2">
                        <a class="nav-link active" aria-current="page" href="../pages/login.php">Login</a>
                    </li>
                    <?php } ?>
                    <?php if (isset($_SESSION['email']) && $_SESSION['email'] != 'Ospite') { ?>
                        <li class="nav-item m-2">
                            <a class="nav-link active" aria-current="page" href="../pages/nuovo_plico.php">Nuovo plico</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link active" aria-current="page" href="../pages/stato_plichi.php">Stato plichi</a>
                        </li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </nav>