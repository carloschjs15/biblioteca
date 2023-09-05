<?php
    session_start();

    if(!isset($_SESSION["login"]) || !isset($_SESSION["senha"])){
        header("Location: login.php");
        exit;
    } else if($_SESSION["permissao"] != 1) {
	header("Location: index.php");
    }
?>
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
        <link href="css/principal.css" rel="stylesheet">
        <link rel="stylesheet" href="fonts/style.css" type="text/css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="fonts/segoi-ui.css">
        <script>
            function successful() {
                jAlert('Dados atualizados com sucesso!', 'Atenção', function(r) {
				    if(r) {
                        location.href = "logout.php";
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
        <div id="special-content">
	        <form method="post" action="">
	            <div id="label">Informe o ano a ser fechado...</div>
	          	<input type="number" min="2016" id="text-field" placeholder="Informe o ano a ser fechado..." required name="ano" />
	            <input type="submit" id="button-update" value="CONFIRMAR" name="update" />
	        </form>
    	</div>
        <?php

        	if(isset($_POST['update'])) {

        		$ano = $_POST['ano'];

        		$dados = array(
	            	'antiga_serie'=>3,
	                'nova_serie'=>$ano
	            );
	            $conn->prepare("UPDATE pessoa SET serie = :nova_serie WHERE serie = :antiga_serie")->execute($dados);

	        	$dados = array(
	            	'antiga_serie'=>2,
	                'nova_serie'=>3
	            );
	            $conn->prepare("UPDATE pessoa SET serie = :nova_serie WHERE serie = :antiga_serie")->execute($dados);

	        	$dados = array(
	            	'antiga_serie'=>1,
	                'nova_serie'=>2
	            );
	            $conn->prepare("UPDATE pessoa SET serie = :nova_serie WHERE serie = :antiga_serie")->execute($dados);

	            echo "<script> successful(); </script>";

        	}

        ?>
    </body>
</html>