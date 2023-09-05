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
                jAlert('Aluno adicionado com sucesso!', 'Atenção', function(r) {
                    if(r) {
                        location.href = "novo_cadastro_aluno.php";
                    }
                });
            }
            function fail() {
                jAlert('Já existe um aluno cadastrado com essa matrícula!', 'Erro', function(r) {
				    if(r) {
                        location.href = "novo_cadastro_aluno.php";
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
            $serie = $_POST['serie'];
            $turma = $_POST['turma'];
            $matricula = $_POST['matricula'];

            $sql = $conn->query('SELECT * FROM pessoa WHERE matricula = ' . $conn->quote($matricula));
            $row = $sql->fetchColumn();

            if($row < 1){
    
                $dados = array(
                    'nome'=>$nome,
                    'serie'=>$serie,
                    'turma'=>$turma,
                    'matricula'=>$matricula
                );

                $conn->prepare("INSERT INTO pessoa (nome,serie,turma,matricula) VALUES (:nome,:serie,:turma,:matricula)")->execute($dados);
                unset($conn);

                echo "<script> successful(); </script>";

            } else {

                echo "<script> fail(); </script>";
            
            }


        ?>
    </body>
</html>
