<?php 
//$msg = $_GET['msg'] ?? 'Funzione omografica riferita agli assi cartesiani';
$msg=filter_input(INPUT_GET, 'msg', FILTER_SANITIZE_STRING);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <p>PRIMO</p>
    <p>SECONDO</p>
    <p>TERZO</p>
    <p><?=$msg?></p>
    <!--p><?=htmlspecialchars($msg)?></p-->
</body>
</html>