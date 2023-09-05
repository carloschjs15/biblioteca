<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Biblioteca</title>
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/jquery.ui.draggable.js" type="text/javascript"></script>
        <!-- Core files -->
        <script src="js/jquery.alerts.js" type="text/javascript"></script>
        <link href="css/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />
        <script>
            function successful() {
                location.href = "index.php";
            }
            function fail() {
                jAlert('Usuário ou senha incorretos!', 'Erro no login', function(r) {
				    if(r) {
                        location.href = "login.php";
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

            $usuario = $_POST['usuario'];
            $senha = $_POST['senha'];

            $sql = $conn->query('SELECT * FROM administrador WHERE login = ' . $conn->quote($usuario) . 'and senha = ' . $conn->quote($senha));
            $row = $sql->fetchColumn();

            if($row > 0){

                session_start();

                $_SESSION['login'] = $usuario;
                $_SESSION['senha'] = $senha;

                $sql = $conn->query('SELECT * FROM administrador WHERE login = ' . $conn->quote($usuario) . 'and senha = ' . $conn->quote($senha));
                foreach ($sql as $value) {
                    $_SESSION['permissao'] = $value['permissao'];
                }
                            
                echo "<script> successful(); </script>";
                            
            } else {

                echo "<script> fail(); </script>";
                        
            }


        ?>
    </body>
</html>