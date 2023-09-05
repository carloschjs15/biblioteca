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
                jAlert('Livro adicionado com sucesso!', 'Atenção', function(r) {
                    if(r) {
                        location.href = "novo_livro.php";
                    }
                });
            }
            function fail() {
                jAlert('Já existe um livro cadastrado com esse código!', 'Erro', function(r) {
				    if(r) {
                        location.href = "novo_livro.php";
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
            $autor = $_POST['autor'];
            $codigo_categoria = $_POST['codigo_categoria'];
            $codigo = $_POST['codigo'];
            $tipo = $_POST['tipo'];

            $sql = $conn->query('SELECT * FROM livro WHERE codigo = ' . $conn->quote($codigo));
            $row = $sql->fetchColumn();

            if($row < 1){
    
                $dados = array(
                    'nome'=>$nome,
                    'autor'=>$autor,
                    'categoria'=>$codigo_categoria,
                    'codigo'=>$codigo,
                    'tipo'=>$tipo
                );

                $conn->prepare("INSERT INTO livro (nome,autor,categoria,codigo,tecnico) VALUES (:nome,:autor,:categoria,:codigo,:tipo)")->execute($dados);
                unset($conn);

                echo "<script> successful(); </script>";

            } else {

                echo "<script> fail(); </script>";
            
            }


        ?>
    </body>
</html>