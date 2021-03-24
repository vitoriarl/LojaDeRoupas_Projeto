<?php
spl_autoload_register(function($classe){
    require('sys/'.$classe.'.class.php');
});
 BD::conn();
 $carrinho = new carrinho();
 if(isset($_POST['acao'])&& $_POST['acao']=='add'){
     $id_produto = (int)$_POST['id'];
     $qtd = (int)$_POST['qtd'];
     $forma=(isset($_POST['forma'])) ? $_POST['forma']:null;

     $carrinho->adicionarCarrinho($id_produto,$qtd,$forma);
     
 }

if(isset($_POST['atualizar'])){
    $qtd = $_POST['qtd'];

    foreach($qtd as $indice => $valor){
        $carrinho->alterarQtd($indice,$valor);

    }
}

 if(isset($_GET['acao'])&& $_GET['acao']== 'del'){
    $id= $_GET['id'];
    $carrinho->excluirQtd($id);
}
 $produtos= $carrinho-> listarProdutos();
 $total = $carrinho->valorTotal();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title> LOJAS VI-NAN</title>
    <link rel="stylesheet" href="css/estiloinicio.css">
</head>
<body>
    <div id="menu">
        <ul>
        <img src="img/logo.png" width="90px" height="100px">
            <li> LOJAS VI-NAN</li>
        </ul>
        <ul>
            <center>
                <li><a href="inicio.php">Produtos</a></li>
                <li><a href="cadastrar.php">Cadastro</a></li>
                <li><a href="carrinho.php">Carrinho</a></li>
                <li><a href="contato.php">Contato</a></li>
        </ul>
        </center>
    </div></br>
    <div class="container">
        <table class="carrinho" border="1" cellppading="0" cellspacing="0">
            <caption>carrinho de compras</caption>
            <thead>
                <tr>
                    <td>Produto</td>
                    <td>Quantidade</td>
                    <td>Preço</td>
                    <td>Subtotal</td>
                    <td>Remover</td>
                </tr>
                
            </thead>
            <form action="" method="post">
                <tfoot>
                    <tr>
                        <td colspan="4">Valor total</td>
                        <td>R$ <?php echo number_format($total, 2,',','.');?></td>
                    </tr>
                    <tr>
                        <td><a class="btn" href="inicio.php">Continuar comprando</a></td>
                </tr>
                </tfoot>
                <tbody>
                <?php
                $contProdutos = count($produtos);
                if($contProdutos == 0 ){
                    echo'<tr><tdcolspan="5">NÃO TEM PRODUTOS NO CARRINHO COMPRE AGORA </td></tr>';
                }else{
                    foreach($produtos as $indice => $produto):
                ?>
                    <tr>
                        <td><?php echo $produto['nome'];?></td>
                        <td> <input type="text" size="3" name="qtd[<?php echo $indice;?>]" value="<?php echo $produto['qtd'];?>"></td>
                        <td>R$ <?php echo number_format($produto['preco'], 2,',','.')?></td>
                        <td>R$ <?php echo number_format($produto['subtotal'],2,',','.')?></td>
                        <td><a class="btn"href="?acao=del&id=<?php echo$indice;?>">Remover</a></td>

                    </tr>
                    <?php endforeach;} ?>
                </tbody>
                
            </form>
        </table>
    </div>

    


</body>
</html>