<?php
$pasti = require_once './return.php';

$pasti_copy = [];

foreach ($pasti as $key => $value) {
    $pasti_copy[$key] = $value;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="./action_page.php" method="post">
    <?php foreach ($pasti as $meal=>$value) { ?>
        <label for="<?= $value ?>"><?= $value ?></label>
        <?php foreach ($value as $item){?>
            <input type="checkbox" name="<?= $item ?>[]" id="<?= $value ?>" value="<?= $item ?>">
    <?php } }?>
</form>
</body>
</html>
