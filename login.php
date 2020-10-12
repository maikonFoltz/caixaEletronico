<?php
session_start();
require './dao/connection/Connection.php';

    if(isset($_POST['agencia']) && !empty($_POST['agencia'])){
    
        $agencia = addslashes($_POST['agencia']);
        $conta = addslashes($_POST['conta']);
        $senha = md5(addslashes($_POST['senha']));

        $sql = $pdo->prepare("SELECT * FROM usuario WHERE agencia = :agencia AND conta = :conta AND senha = :senha");
        $sql->bindValue(":agencia", $agencia);  
        $sql->bindValue(":conta", $conta); 
        $sql->bindValue(":senha", $senha);  
        $sql->execute();

        if ($sql->rowCount() > 0){
            $sql = $sql->fetch();

            $_SESSION['banco'] = $sql['id'];
            header("Location: index.php");
            exit;

        }
    }    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
</head>
<body>
    <form action="" method="post">
        Agencia: <br>
        <input type="text" name="agencia" id=""> <br><br>
        Conta: <br>       
        <input type="text" name="conta" id=""> <br><br>
        Senha: <br>
        <input type="password" name="senha" id=""> <br><br>
        <input type="submit" value="Entrar">

    </form>
</body>
</html>