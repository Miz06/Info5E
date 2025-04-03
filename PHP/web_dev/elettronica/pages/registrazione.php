<?php
ob_start();
$title = "Registrazione";

require '../references/navbar.php';

$config = require '../references/connectionToDB/databaseConfig.php';
$db = DBconn::getDB($config);

$queryInsertUser = "INSERT INTO admins (nome, email, password) values(:nome, :email, :password)";

if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['password'])){
    try{
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stm = $db -> prepare($queryInsertUser);
        $stm->bindValue(':nome', $_POST['nome']);
        $stm->bindValue(':email', $_POST['email']);
        $stm->bindValue(':password', $hashed_password);
        $stm->execute();
        $_SESSION['nome_user'] = $_POST['nome'];
        $_SESSION['email_user'] = $_POST['email'];
        $stm->closeCursor();
        header('Location: ./account.php');
    }catch(Exception $e){
        logError($e);
    }
}
?>

<div class="element">
    <h4>Non hai un account user? Registrati</h4>
    <form action="registrazione.php" method="post">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="nome">Nome</label>
        <input type="password" id="nome" name="nome" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Registrati">
    </form>
</div>

</body>
</html>
