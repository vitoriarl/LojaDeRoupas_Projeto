<?php
spl_autoload_register(function($classe){
    require_once('sys/'.$classe.'.class.php');
});
 BD::conn();
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
        <img src="img/logo.jpg" width="150px" height="100px">
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
        <ul class="lista">
        <?php
            $queryProdutos = BD::conn()->prepare("SELECT * FROM `produtos` ORDER BY id DESC");
            $queryProdutos->execute();
            while($fetchProduto = $queryProdutos->fetchObject()){
        ?>

            <li>
                <img src="img/<?php echo $fetchProduto ->imagem; ?>" alt="" width="150px" height="200">
                <span><?php echo $fetchProduto->nome; ?></span>
                <a class="btn" href="single.php?produto_id=<?php echo $fetchProduto->id; ?>">ver detalhes</a>
            </li>
           
            <?php
            }
            ?>
        </ul>
    </div> 

    


</body>
</html>