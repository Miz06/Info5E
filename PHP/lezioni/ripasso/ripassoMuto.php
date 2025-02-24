<?php
$alimentari = require_once 'alimentari.php';

//modi per fare copie di array:
$duplicatoDiAlimentari=[];
foreach ($alimentari as $alimento=>$item)
    $duplicatoDiAlimentari[$alimento] = $item;
//var_dump($duplicatoDiAlimentari);

$secondoDuplicatoDiAlimentari = [];
foreach ($alimentari as $alimento=>$item)
    $secondoDuplicatoDiAlimentari+=[$alimento => $item];
//var_dump($secondoDuplicatoDiAlimentari);

$tipoAlimentari = array_keys($alimentari);
//var_dump($tipoAlimentari);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<?php foreach($duplicatoDiAlimentari as $tipoAlimento => $alimenti){?>
    <h2><?= $tipoAlimento?></h2>
    <?php foreach($alimenti as $sceltaAlimento){?>
        <p><?= $sceltaAlimento?></p>
    <?php } ?>
<?php } ?>
<hr>
<p><?=$alimentari['frutta'][0]?></p>
<hr>
<?php foreach($alimentari['frutta'] as $frutta){?>
    <p><?= $frutta?></p>
<?php } ?>
<hr>
<form action = "action_page.php" method="post">
    <?php for($i = 0; $i < count($alimentari); $i++){?>
        <p><?= $tipoAlimentari[$i]?></p>
        <label for = "<?=$i?>Val">Valutazione del servizio</label><br>
        <input type="number" name ="<?=$i?>Val" id = "<?=$i?>Val" min = "1" max = "5"><br>
        <label for = "<?=$i?>Car">Carta di credito</label><br>
        <input type="checkbox" name ="<?=$i?>Car" id = "<?=$i?>Car"><br>
        <label for = "<?=$i?>Cons">Consegna a domicilio</label> <br>
        <input type="checkbox" name ="<?=$i?>Cons" id = "<?=$i?>Cons"><br>
    <?php } ?>
    <input type="hidden" name ="count" value="<?=count($alimentari)?>">
    <input type="submit" value="Invia">
</form>
</body>
</html>