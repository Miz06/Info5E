<?php
session_start();
require '../references/functions.php';
require '../connectionToDB/DBconn.php';

$config = require '../connectionToDB/databaseConfig.php';;
$db = DBconn::getDB($config);

$queryNomeUtente = 'SELECT nome FROM db_FastRoute.personale WHERE email = :email';

if (isset($_SESSION['email'])) {
    try {
        $stm = $db->prepare($queryNomeUtente);
        $stm->bindValue(':email', $_SESSION['email']);
        $stm->execute();
        $nomeUtente = $stm->fetchColumn();
        $stm->closeCursor();
        $_SESSION['nome'] = $nomeUtente;
    } catch (Exception $e) {
        logError($e);
        $nomeUtente = "Ospite";
    }
} else if (isset($_COOKIE['nome'])) {
    $nomeUtente = $_COOKIE['nome'];
    $_SESSION['nome'] = $_COOKIE['nome'];
    $_SESSION['email'] = $_COOKIE['email'];
    $_SESSION['nav_color'] = $_COOKIE['nav_color'];
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

        .footer {
            background-color: black;
            color: white;
            text-align: center;
            width: 100%;
            padding-top: 2%;
            padding-bottom: 1%;
            margin-top: 3%;
        }

        input[type="radio"] {
            vertical-align: middle; /* Allinea verticalmente */
            border: 1px solid black;
        }

        label {
            margin-left: 1%;
            vertical-align: middle; /* Assicura l'allineamento */
            display: inline-block;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100" style="background-color: whitesmoke">
<div class="flex-grow-1">
    <?php if (isset($_SESSION['nav_color']) && isset($_SESSION['email'])) { ?>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: <?= $_SESSION['nav_color'] ?>">
        <?php }else if (isset($_COOKIE['nav_color']) && isset($_COOKIE['email'])) { ?>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: <?= $_COOKIE['nav_color'] ?>">
            <?php }else{ ?>
            <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: black;">
                <?php } ?>
                <div class="container-fluid">
                    <a class="navbar-brand account" href="../pages/account.php"><?= $nomeUtente ?></a>
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
                            <?php if (!isset($_SESSION['email']) && !isset($_COOKIE['email'])) { ?>
                                <li class="nav-item m-2">
                                    <a class="nav-link active" aria-current="page" href="../pages/login.php">Login</a>
                                </li>
                            <?php } ?>
                            <?php if (isset($_SESSION['email']) || isset($_COOKIE['email'])) { ?>
                                <li class="nav-item m-2">
                                    <a class="nav-link active" aria-current="page" href="../pages/nuovo_plico.php">Nuovo
                                        plico</a>
                                </li>
                                <li class="nav-item m-2">
                                    <a class="nav-link active" aria-current="page" href="../pages/info_plichi.php">Info
                                        plichi</a>
                                </li>
                                <li class="nav-item m-2">
                                    <a class="nav-link active" aria-current="page" href="../pages/dashboard.php">Dashboard</a>
                                </li
                            <?php } ?>

                        </ul>
                    </div>
                </div>
            </nav>