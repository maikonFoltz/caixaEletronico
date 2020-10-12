<?php
session_start();
require './dao/connection/Connection.php';

if(isset($_POST['tipo']) && !empty($_POST['tipo'])){
    $tipo = addslashes($_POST['tipo']);
    $valor = str_replace(",", ".",$_POST['valor']);
    echo $tipo;
    $sql = $pdo->prepare("INSERT INTO historico (id_conta, tipo, valor, data_operacao) VALUES (:id_conta, :tipo, :valor, NOW())");
    $sql->bindValue(":id_conta", $_SESSION['banco']);
    $sql->bindValue(":tipo", $tipo);
    $sql->bindValue(":valor", $valor);
    $sql->execute();

    header("Location: index.php");
    
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
        Tipo Transação:
        <select name="tipo" id="">          
            <option value="0">Entrada</option>
            <option value="1">Saida</option>
        </select><br><br>
        Valor: <br>
        <input type="text" name="valor" pattern="[0-9.,]{1,}"><br><br>
        <input type="submit" value="Adicionar">

    </form>
</body>
</html>