<?php
    session_start();
    require './dao/connection/Connection.php';

    if(isset($_SESSION['banco'])){
        $id = $_SESSION['banco'];
    
        $sql = $pdo->prepare("SELECT * FROM usuario WHERE id = '$id'");        
        $sql->execute();

        if($sql->rowCount() > 0){
            $info = $sql->fetch();

        }else{
            header("Location: login.php");
            exit;
        }

    }else{
        header("Location: login.php");
        exit;
    }


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caixa Eletronico</title>
</head>
<body>
    <h1>Banco XYZ</h1> <br>
    Usuario: <?php echo $info["nome"]?> <br><br>
    Agencia: <?php echo $info["agencia"]?> <br>
    Conta: <?php echo $info["conta"]?> <br>
    Saldo: <?php echo $info["saldo"]?><br>
    <a href="sair.php">Sair</a>
    <hr>
    <h3>Movimentações</h3> 
    <a href="adicionar.php">Adicionar Transação</a>
    <br><br>
    <table border="1" width="400">
        <tr>
            <th>Data</th>
            <th>Valores</th>
        </tr>
        <?php
            $sql = $pdo->prepare("SELECT * FROM historico WHERE id_conta = '$id'");
            $sql->execute();

            if($sql->rowCount() > 0){
               foreach($sql->fetchAll() as $dados){
               ?>
               <tr>
                   <td><?php echo date('d/m/Y H:i', strtotime($dados['data_operacao']));?></td>
                   <td>
                       <?php if($dados['tipo'] == '0'):?>
                       <span color="green">R$ <?php echo $dados['valor']?></td></span>
                       <?php else: ?>
                        <span color="red">- R$ <?php echo $dados['valor']?></td></span>
                       <?php endif; ?> 
               </tr>
               <?php    
               }
            }
        
        ?>
        
    </table>
</body>
</html>