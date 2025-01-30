<?php
$content = 'dati provenienti dal database';
$db= new PDO("mysql:host=localhost;dbname=itis", "root", "",[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]);
$query='select * from studenti';
try{
    $stm=$db->prepare($query);
    $stm->execute();
    ob_start(); //il buffer creato viene riempito di tutti gli eco specificati di seguio
    //gli eco vengono quindi dirottati dalla pagina al buffer
    while($studente=$stm->fetch()){
        echo"Nome: ".$studente->nome."<br>";
        echo"Cognome: ".$studente->cognome."<br>";
        echo"Media: ".$studente->media."<br>";
        echo"Data Iscrizione: ".$studente->data_iscrizione."<br>";
        echo"Matricola: ".$studente->matricola_studente."<hr>";
    }
    $content = ob_get_contents(); //viene preso il contenuto del buffer
    ob_end_clean(); //pulizia buffer
    $stm->closeCursor();
}catch(Exception $e){
//echo $e->getMessage();
    logError($e);
}
require 'header.php';
?>
    <div>
        <p>Buongiorno</p>
        <p><?=/**@var $content*/$content?></p>

        <!-- <p><?=/**@var $content*/$content?></p>  modo 1 di scrivere-->
        <!-- /**@var $content*/  contente di specificare il fatto che la variabile content giunge dall'esterno del file -->
        <!-- <p><?php echo $content?></p>  modo 2 di scrivere-->
    </div>
<?php
require 'footer.php';
//le pagine dell'applicazione hanno tutte la stessa navbar e footer i quali vengono aggiornati automaticamente ovunque una volta modificata la pagina specifica
?>
