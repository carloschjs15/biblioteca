<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Biblioteca</title>
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/jquery.ui.draggable.js" type="text/javascript"></script>
        <script src="js/jquery.alerts.js" type="text/javascript"></script>
        <link href="css/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />
        <script>
            function successful() {
                jAlert('Coordenador adicionado com sucesso! Consulte os cadastros de coordenadores para saber o código do mesmo!', 'Atenção', function(r) {
                    if(r) {
                        location.href = "novo_cadastro_professor.php";
                    }
                });
            }
            function fail() {
                jAlert('As senhas não correspondem!', 'Erro', function(r) {
				    if(r) {
                        location.href = "novo_cadastro_professor.php";
                    }
				});
            }
        </script>
    </head>
    <body>

        <?php
            //Chama o arquivo de conexão
            require('conecta_db.php');
        ?>
        
        <?php

            $nome = $_POST['nome'];
            $categoria_livros = $_POST['categoria_livros'];
            $senha = $_POST['senha'];
            $confirmacao_senha = $_POST['confirmacao_senha'];
    
            if($senha == $confirmacao_senha) {

                $dados = array(
                    'nome'=>$nome,
                    'categoria_livros'=>$categoria_livros,
                    'senha'=>$senha
                );

                $conn->prepare("INSERT INTO professor (nome,categoria_livros,senha) VALUES (:nome,:categoria_livros,:senha)")->execute($dados);
                unset($conn);

                echo "<script> successful(); </script>";

            } else {

                echo "<script> fail(); </script>";

            }

        ?>
    </body>
</html>
