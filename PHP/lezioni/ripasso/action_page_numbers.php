<?php
$numeri=$_POST['numero'];
if(isset($numeri) && isset($_POST['tip']))
    for($i=0;$i<$_POST['tip'];$i++)
        echo $numeri[$i].'<br>';
