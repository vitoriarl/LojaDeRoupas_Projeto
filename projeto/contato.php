<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> Contato </title>
    <link rel="stylesheet" type="text/css" href="css/faleconosco.css" <script src="JavaScript/contato.js">
    </script>
</head>

<body>
    <div id="menu">
        <ul>
        </ul>
    </div>

    <div class="barra">
        <footer>
        </footer>
    </div>
    <div class="titulo">
        <p> Fale Conosco! </p>
    </div>

    <section class="contato">

        <div class="grupo">
            <form class="formcontato" name="forcontato" action="contato.html" method="POST" onsubmit="return validacao()">


                <input class="field" type="text" name="nome" placeholder="Digite seu nome completo" /> </br>

                <input class="field" type="text" name="email" placeholder="Digite seu email" /> </br>

                <input class="field" type="text" name="telefone" placeholder="Digite seu telefone" /> </br>

                <input class="field" type="text" name="datanasc" placeholder="Digite sua Data de Nascimento" /> </br>

                <input class="field" type="text" name="bairro" placeholder="Digite seu bairro" /></br>

                <input class="field" type="text" name="rua" placeholder="Digite sua rua" /></br>

                <input class="field" type="number" name="numero" placeholder="Digite o número da sua casa" /></br>

                <input class="field" type="text" name="cidade" placeholder="Digite sua cidade" /></br>

                <textarea class="field" type="text" name="mensagem" placeholder=" Mensagem "></textarea> </textarea> </br>

                <input class="field" type="submit" name="salvar" value="Enviar" />
                <input class="field" type="reset" value="Limpar Formulário">

            </form>
        </div>
    </section>

    <div class="rodape">

        <body>
            <center>
                <div class="social-midia">

                    <div class="section footer">
                        <div>
                            <h4>Desenvolvido com muito amor carinho ♥ </h4>
                            <h5>Copyright &copy; Lojas Vi-Nan - <span id="date"></span></h5>
                            <a href="https://www.facebook.com/Renaansanttos" target="_blank"> <img src="img/facebook.png" width="60" height="60"> </a>
                            <a href="https://www.instagram.com/renancom2nn/" target="_blank"> <img src="img/instagram.png" width="60" height="60"> </a>

                        </div>
                    </div>
            </center>

        </body>
    </div>


</body>

</html>