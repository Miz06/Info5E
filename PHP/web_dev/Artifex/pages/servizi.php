<?php
ob_start();
$title = 'Servizi';

require '../references/navbar.php';

require '../connectionToDB/DBconn.php';
$config = require '../connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);
?>

<header class="bg-light py-5 text-center">
    <div class="container" >
        <h1 class="display-5 fw-bold">Scopri il mondo con Artifex Turismo</h1>
        <p class="lead">Esperienze uniche, guide esperte, prenotazioni semplici.</p>
        <?php if(isset($_SESSION['email'])){?>
            <a href="./eventi.php" class="btn btn-primary acc">Prenota ora</a>
        <?php } else {?>
            <a href="./account.php" class="btn btn-primary acc">Prenota ora</a>
        <?php }?>
    </div>
</header>

<section class="container py-5" style="background-color: darkslategray">
    <h2 class="text-center mb-4" style="color: white">I nostri servizi</h2>
    <div class="row g-4" style="text-align: center">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Visite Guidate</h5>
                    <p class="card-text">Esplora città d'arte, musei e siti storici accompagnato da guide turistiche professionali e appassionate.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Prenotazione Online</h5>
                    <p class="card-text">Prenota la tua esperienza comodamente da casa. Il nostro sistema è semplice, veloce e sicuro.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Tour Personalizzati</h5>
                    <p class="card-text">Hai esigenze particolari? Crea il tuo itinerario su misura con l'aiuto del nostro team esperto.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php require '../references/footer.php'; ?>
