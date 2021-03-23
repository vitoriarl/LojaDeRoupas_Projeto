<?php
class Carrinho{
    public function __construct(){
        if(! isset($_SESSION['carrinho'])){
            $_SESSION['carrinho'] = array();
        }
    }

    public function adicionarCarrinho($id,$qtd=1,$form_id=null){
        if(is_null($form_id)){
            $indice= sprintf("%s:%s",(int)$id,0);
        }else{
            $indice=sprintf("%s:%s",(int)$id,(int)$form_id);
        }

        if(!isset($_SESSION['carrinho'][$indice])){
            $_SESSION['carrinho'][$indice]=(int)$qtd;
        }
    }
    public function alterarQtd($indice,$qtd){
        if(isset($_SESSION['carrinho'][$indice])){
            if($qtd > 0){
                $_SESSION['carrinho'][$indice]= (int)$qtd;
            }
        }
    }

    public function excluirQtd($indice){
        unset($_SESSION['carrinho'][$indice]);
    }

    public function listarProdutos(){
        $reton=array();
        foreach($_SESSION['carrinho'] as $indice => $qtd){
            list($id, $form_id)= explode(":", $indice);
        
            $query = BD::conn()-> prepare("SELECT * FROM produtos WHERE id =?");
            $query->execute(array($id));
            $result = $query->fetchObject();
            $reton[$indice]['nome'] =$result->nome;
            $reton[$indice]['preco'] =$result->preco;
            $reton[$indice]['qtd'] =$qtd;
            $reton[$indice]['imagem'] =$result->imagem;
            $reton[$indice]['subtotal'] =$result->preco*$qtd;
            $reton[$indice]['forma'] ='';

            if($form_id>0){
                $query_form= BD::conn()->prpare("SELECT * FROM 'forma' where id=?");
                $query_form->execute(array($form_id));
                $fetchForm=$query_form->fetObject();

                $reton[$indice]['forma'] = $fetchForm -> forma;

            }
        }
        return $reton;
    }

    public function valorTotal(){
        $produtos = $this->listarProdutos();
        $total=0;
        foreach($produtos as $indice =>$linha){
        $total +=$linha['subtotal'];
        }
        return $total;
    }

    }

?>