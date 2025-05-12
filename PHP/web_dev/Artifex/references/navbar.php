<?php
session_start();

function logError(Exception $e): void
{
    error_log($e->getMessage() . '---' . date('Y-m-d H:i:s' . "\n"), 3, '../log/DB_Errors_log');
}

if (isset($_COOKIE['email']) && !isset($_COOKIE['nome'])) {
    $_SESSION['email'] = $_COOKIE['email'];
    $_SESSION['nome'] = $_COOKIE['nome'];
}

if (isset($_SESSION['nome'])) {
    $nomeUtente = $_SESSION['nome'];
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

        .footer {
            background-color: black;
            color: white;
            text-align: center;
            width: 100%;
            padding-top: 2%;
            padding-bottom: 1%;
            margin-top: 3%;
        }

        .container {
            background: white;
            padding: 3%;
            margin: 20px auto;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .log-out {
            display: inline-block;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            background-color: darkred;
            color: white;
        }

        .acc {
            display: inline-block;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            background-color: green;
            color: white;
        }

        .btn:hover {
            background-color: grey;
        }

        .account {
            border: 1px solid white;
            padding: 1%;
            margin: 1%;
            border-radius: 5px;
            color: white;
            background-color: darkslategray;
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
            background-color: grey;
        }

        label {
            margin-left: 1%;
            vertical-align: middle; /* Assicura l'allineamento */
            display: inline-block;
            color: black;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: darkslategray;
            color: white;
            cursor: pointer;
            width: 70%;
        }

        .submit-container {
            display: flex;
            justify-content: center; /* Centra orizzontalmente */
            margin: 10px 0;
        }

        input[type="submit"]:hover {
            background-color: grey;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100" style="background-color: whitesmoke">
<div class="flex-grow-1">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: black;">
        <div class="container-fluid">
            <a class="navbar-brand account" href="../pages/account.php"><?= $nomeUtente ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php if (empty($_SESSION['email'])) { ?>
                        <li class="nav-item m-2">
                            <a class="nav-link active" aria-current="page"
                               href="../pages/login.php">Accedi</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link active" aria-current="page"
                               href="../pages/registrazione.php">Registrati</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item m-2">
                            <a class="nav-link active" aria-current="page"
                               href="../pages/prenotazione_eventi.php">Prenota eventi</a>
                        </li>
                    <?php } ?>
                    <li class="nav-item m-2">
                        <a class="nav-link active" aria-current="page"
                           href="../pages/servizi.php">Servizi</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
