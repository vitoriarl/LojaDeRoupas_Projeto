<?php
session_start();
include("conexao.php");
$consulta = "select * from produto";
$con = mysqli_query($conexao, $consulta);
?>

<?php
if(isset($_SESSION['venda'])) {
} else {
    $_SESSION['venda'] = array();
}

if(isset($_GET['par'])) {
    $Produto = $_GET['par'];
    $_SESSION['venda'][$Produto] = 1;
}

if(isset($_GET['del'])) {
    $Del = $_GET['del'];
    unset($_SESSION['venda'][$Del]);
}
?>
<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carrinho de Compras</title>
</head>
<body>
    <h1>Produtos</h1>
    <ul>
        <?php
            while($dado = $con->fetch_array()) {
        ?>
        <li>
            <span><?php echo $dado['produto_nome']?></span>
            <strong><a href="carrinho.php?par=<?php echo $dado['produto_id']?>">R$ <?php echo $dado['produto_preco']?></a></strong>
        </li>
        <?php
            }
        ?>
    </ul>
    <table id="tabela" border="2" cellspacing="5">
                <thread>
                    <tr>
                        <th>Produto</th>
                        <th>Valor</th>
                        <th>Quantidade</th>
                        <th>Acoes</th>
                    </tr>
                </thread>
                <tbody>
                    <tr>
                        <?php
                            foreach($_SESSION['venda'] as $Prod => $Quantidade) {
                                $sqlCarrinho = mysqli_query($conexao, "select * from produto where produto_id = '$Prod'");
                                $resAss = mysqli_fetch_assoc($sqlCarrinho);
                                echo '<td>'.$resAss['produto_nome'].'</td>';
                                echo '<td>'.$resAss['produto_preco'].'</td>';
                                echo '<td>'.$Quantidade.'</td>';
                                echo '<td><a href="carrinho.php?del='.$resAss['produto_id'].'">X</a></td>';
                                $Total += $resAss['produto_preco'] * $Quantidade;
                                echo '</tr>';
                                }
                                echo '</tr>';
                                echo '<td colspan="4" align="right">R$ '.$Total.'</td>';
                        ?>
                </tbody>
            </table>
            <form action="" type="multipart/form" method="post">
                    <input type="submit" name="enviar" value="Finalizar pedido">
            </form>
            <?php
                if(isset($_POST['enviar'])) {
                    $sqlVenda = "insert into venda(venda_total) values ('$Total')";
                    $sqlInserirVenda = mysqli_query($conexao, $sqlVenda);
                    $idVenda = $mysqli->insert_id($sqlVenda);
                    
                    foreach($_SESSION['venda'] as $ProdInsert) {
                        $sqlInsertItens = mysqli_query($conexao, "insert into tem(tem_id_venda, tem_id_produto) values ('$idVenda', '$ProdInsert')");
                    }
                    echo "<script>alert('Venda concluida com sucesso!')</script>";
                }
            ?>

</body>

</html>