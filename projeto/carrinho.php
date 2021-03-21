<?php
session_start();
include("conexao.php");
$consulta = "select * from produto";
$con = mysqli_query($conexao, $consulta);
?>
<!DOCTYPE html>
<html>

<head>

    <?php
    if (isset($_SESSION['venda'])) {
    } else {
        $_SESSION['venda'] = array();
    }

    if (isset($_GET['par'])) {
        $Produto = $_GET['par'];
        $_SESSION['venda'][$Produto] = 1;
    }

    if (isset($_GET['del'])) {
        $Del = $_GET['del'];
        unset($_SESSION['venda'][$Del]);
    }
    ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carrinho de Compras</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h2.title {
            background-color: #e9bbdd;
            width: 100%;
            padding: 20px;
            text-align: center;
            color: white;

        }

        .carrinho-container {
            display: flex;
        }

        .produto {
            width: 33.3%;
            padding: 0 30px;
        }

        .produto img {
            max-width: 100%;
        }

        .produto a {
            display: block;
            width: 100%;
            padding: 10px;
            color: white;
            background-color: #5fb382;
            text-align: center;
            text-decoration: none;
        }

        .carrinho-item{
            max-width: 1200px;
            margin: 10px auto;
            padding-bottom: 10px;

            border-bottom: 2px dotted #ccc;
        }

        .carrinho-item p{
            font-size: 19px;
            color: black;
        }
    </style>
</head>

<body>

<hl><h2 class="title">Produtos</h2></hl>
    <ul>
        <?php
        while ($dado = $con->fetch_array()) {
        ?>
            <li>
                <span><?php echo $dado['produto_nome'] ?></span>
                <strong><a href="carrinho.php?par=<?php echo $dado['produto_id'] ?>">R$ <?php echo $dado['produto_preco'] ?></a></strong>
            </li>
        <?php
        }
        ?>
    </ul>
    <hl><h3 class="title"><table id="tabela" border="2" cellspacing="5"></hl></h3>
        <thread>
            <tr>
                <bgcolor="#e9bbdd"><th>Produto</th></bgcolor>
                <th>Valor</th>
                <th>Quantidade</th>
                <th>Acoes</th>
            </tr>
        </thread>
        <tbody>
            <tr>
                <?php
                foreach ($_SESSION['venda'] as $Prod => $Quantidade) {
                    $sqlCarrinho = mysqli_query($conexao, "select * from produto where produto_id = '$Prod'");
                    $resAss = mysqli_fetch_assoc($sqlCarrinho);
                    echo '<td>' . $resAss['produto_nome'] . '</td>';
                    echo '<td>' . $resAss['produto_preco'] . '</td>';
                    echo '<td>' . $Quantidade . '</td>';
                    echo '<td><a href="carrinho.php?del=' . $resAss['produto_id'] . '">X</a></td>';
                   $Total += $resAss['produto_preco'] * $Quantidade;
                    echo '</tr>';
                }
                echo '</tr>';
                echo '<td colspan="4" align="right">R$ ' . $Total .'</td>';
                ?>
        </tbody>
    </table>
    <form action="" type="multipart/form" method="post">
    <hl><h2 class="title"><input type="submit" name="enviar" value="Finalizar pedido"></h2></hl>  
    </form>
    <?php
    if (isset($_POST['enviar'])) {
        $sqlVenda = "insert into venda(venda_total) values ('$Total')";
        $sqlInserirVenda = mysqli_query($conexao, $sqlVenda);
        $idVenda = $mysqli->insert_id($sqlVenda);

        foreach ($_SESSION['venda'] as $ProdInsert) {
            $sqlInsertItens = mysqli_query($conexao, "insert into tem(tem_id_venda, tem_id_produto) values ('$idVenda', '$ProdInsert')");
        }
        echo "<script>alert('Venda concluida com sucesso!')</script>";
    }
    ?>

</body>

</html>