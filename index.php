<?php
    session_start();
    if(!isset($_SESSION["login"]) || !isset($_SESSION["senha"])){
        header("Location: login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Biblioteca</title>
        <link href="css/principal.css" rel="stylesheet">
        <link rel="stylesheet" href="fonts/style.css" type="text/css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="fonts/segoi-ui.css">
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/jquery.ui.draggable.js" type="text/javascript"></script>
        <script src="js/jquery.alerts.js" type="text/javascript"></script>
        <link href="css/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />
        <script type="text/javascript">
            
            function successful() {
                jAlert('Locação efetuada com sucesso!', 'Atenção', function(r) {
                    if(r) {
                        location.href = "index.php";
                    }
                });
            }

            function fail1() {
                jAlert('O aluno especificado não existe!', 'Erro', function(r) {
                    if(r) {
                        location.href = "index.php";
                    }
                });
            }

            function fail2() {
                jAlert('O livro especificado não existe!', 'Erro', function(r) {
                    if(r) {
                        location.href = "index.php";
                    }
                });
            }

            function fail3() {
                jAlert('Esse livro já está locado!', 'Erro', function(r) {
                    if(r) {
                        location.href = "index.php";
                    }
                });
            }

            function fail4() {
                jAlert('A data final precisa ser maior que a data inicial!', 'Erro', function(r) {
                    if(r) {
                        location.href = "index.php";
                    }
                });
            }

             function fail5() {
                jAlert('Código ou senha incorretos ou professor inexistente!', 'Erro', function(r) {
                    if(r) {
                        location.href = "index.php";
                    }
                });
            }

        </script>
        <script type="text/javascript">
            
            function loadWindowAuthentication() {

                $(document).ready(function(){
                 
                    var id = "#password-window";
                 
                    var alturaTela = $(document).height();
                    var larguraTela = $(window).width();
                     
                    //colocando o fundo preto
                    $('#mask').css({'width':larguraTela,'height':alturaTela});
                    $('#mask').fadeIn(1000); 
                    $('#mask').fadeTo("slow",0.8);
                 
                    var left = ($(window).width() /2) - ( $(id).width() / 2 );
                    var top = ($(window).height() / 2) - ( $(id).height() / 2 );
                     
                    $(id).css({'top':top,'left':left});
                    $(id).show();   
                 
                    $("#mask").click( function(){
                        $(this).hide();
                        $(".window").hide();
                    });
                 
                    $('.close').click(function(ev){
                        ev.preventDefault();
                        $("#mask").hide();
                        $(".window").hide();
                    });

                });

            }

        </script>
    </head>
    <body>
    
        <div id="main-menu">
            <a href="update.php">
                <div id="detail-main-menu">
                    EEEP Dr. José Alves da Silveira
                </div>
            </a>
            <div id="content-main-menu">
                <a href="index.php">
                    <div id="button-main-menu-now">
                        LOCAÇÔES
                    </div>
                </a>
                <div id="white-line"></div>
                <a href="novo_cadastro_aluno.php">
                    <div id="button-main-menu">
                        CADASTROS
                    </div>
                </a>
                <div id="white-line"></div>
                <a href="novo_livro.php">
                    <div id="button-main-menu">
                        LIVROS
                    </div>
                </a>
                <div id="white-line"></div>
                <a href="relatorios.php">
                    <div id="button-main-menu">
                        RELATÓRIOS
                    </div>
                </a>
                <div id="white-line"></div>
                <a href="logout.php">
                    <div id="button-main-menu">
                        SAIR
                    </div>
                </a>
            </div>
        </div>
        
        <div id="title">
            <div id="logo-title"></div>
            Biblioteca E.p. Dr. José Alves
            <div id="white-line"></div>
        </div>
        
        <div id="content">
            <a href="index.php">
                <div id="button-sub-menu-active">
                    Nova
                </div>
            </a>
            <a href="consultar_locacoes.php">
                <div id="button-sub-menu">
                    Consultar
                </div>
            </a>
            <div id="black-line"></div>

            <?php

                date_default_timezone_set('America/Fortaleza');

                $today = date('Y-m-d');

                $next_today = date('Y-m-d', strtotime(' + 7 days'));

            ?>

            <div id="title-label">NOVA LOCAÇÃO</div>
            <form method="post" action="index.php">
                <div id="label">Número de matrícula</div>
                <input type="number" id="text-field" placeholder="Informe um número de matrícula válido..." required name="matricula" />
                <div id="label">Código do livro</div>
                <input type="number" id="text-field" placeholder="Informe um código de livro válido..." required name="codigo" />
                <div id="label">Data da locação</div>
                <input type="date" id="text-field" required value="<?php echo $today; ?>" name="data_inicial"/>
                <div id="label">Data de devolução</div>
                <input type="date" id="text-field" required value="<?php echo $next_today; ?>" name="data_final"/>
                <input type="submit" id="button-submit" value="CONFIRMAR" name="enviar1" />
            </form>
        </div>
        
        <?php

            //Chama o arquivo de conexão
            require('conecta_db.php');

        ?>

        <?php

            if (isset($_POST['enviar1'])) {

                $matricula = $_POST['matricula'];
                $codigo = $_POST['codigo'];
                $data_inicial = $_POST['data_inicial'];
                $data_final = $_POST['data_final'];

                $sql = "SELECT * FROM `pessoa` WHERE `matricula` = $matricula";
                $result = $conn->query($sql);
                $rows = $result->rowCount();

                if ($rows > 0) {

                    $sql = "SELECT * FROM `livro` WHERE `codigo` = $codigo";
                    $result = $conn->query($sql);
                    $rows = $result->rowCount();

                    if ($rows > 0) {
                        
                        $result = $conn->query('SELECT * FROM livro WHERE codigo = ' . $conn->quote($codigo));

                        foreach ($result as $value) {
                            
                             if ($value['locado'] == 0) {

                                if (strtotime($data_inicial) < strtotime($data_final)) {

                                    if ($value['tecnico'] == 0) {
                                        
                                        $dados = array(
                                            'matricula'=>$matricula,
                                            'codigo'=>$codigo,
                                            'data_inicial'=>$data_inicial,
                                            'data_final'=>$data_final,
                                            'estado'=>1
                                        );

                                        $consulta = $conn->prepare("INSERT INTO locacao (matricula,codigo,data_inicial,data_final,estado) VALUES (:matricula,:codigo,:data_inicial,:data_final,:estado)");
					$consulta->execute($dados);

                                        $dados = array(
                                            'codigo'=>$codigo,
                                            'locado'=>1
                                        );

                                        $conn->prepare("UPDATE livro SET locado = :locado WHERE codigo = :codigo")->execute($dados);

                                        echo "<script> successful(); </script>";

                                    } else {
                                        
                                        echo "<script> loadWindowAuthentication(); </script>";

                                    }
                                    

                                } else {

                                    echo "<script> fail4(); </script>";

                                }

                             } else {

                                echo "<script> fail3(); </script>";

                             }

                        }

                    } else {
                        
                        echo "<script> fail2(); </script>";
                        
                    }
                    

                } else {

                    echo "<script> fail1(); </script>";

                }

            }

        ?>

        <div class="window" id="password-window">
            <div id="title-window">* AUTENTICA&Ccedil;&Atilde;O</div>
            <a href="#" class="close">
                <div id="close">X</div>
            </a>
            <div id="black-line"></div>
            <form method="post" action="index.php">
                <input type="number" id="text-field" name="matricula" hidden value="<?= $matricula ?>" />
                <input type="number" id="text-field" name="codigo" hidden value="<?= $codigo ?>" />
                <input type="date" id="text-field" name="data_inicial" hidden value="<?= $data_inicial ?>"/>
                <input type="date" id="text-field" name="data_final" hidden value="<?= $data_final ?>" />
                <div id="label">Código de coordenador responsável pela categoria</div>
                <input type="number" id="text-field" name="id" required/>
                <div id="label">Senha de coordenador responsável pela categoria</div>
                <input type="password" id="text-field" name="senha" required/>
                <input type="submit" id="button-submit" value="CONFIRMAR" name="enviar2" />
            </form>
        </div>

        <!-- mascara para cobrir formulário da janela secundária -->  
        <div class="mask" id="mask"></div>

        <?php

            if (isset($_POST['enviar2'])) {

                $matricula = $_POST['matricula'];
                $codigo = $_POST['codigo'];
                $data_inicial = $_POST['data_inicial'];
                $data_final = $_POST['data_final'];
                $id = $_POST['id'];
                $senha = $_POST['senha'];

		$sql = $conn->query('SELECT * FROM `professor` WHERE `id` = ' . $conn->quote($id) . 'and `senha` = ' . $conn->quote($senha))->fetchAll();
            	$rows = count($sql);

                if ($rows > 0) {

                    $dados = array(
                        'matricula'=>$matricula,
                        'codigo'=>$codigo,
                        'data_inicial'=>$data_inicial,
                        'data_final'=>$data_final,
                        'estado'=>1,
                        'permissao'=>$id
                    );

			
		    $sql = "INSERT INTO locacao (matricula,codigo,data_inicial,data_final,estado,permissao) VALUES (:matricula,:codigo,:data_inicial,:data_final,:estado,:permissao)";
                    $consulta = $conn->prepare($sql);
		    $consulta->execute($dados); 		

                    $dados = array(
                        'codigo'=>$codigo,
                        'locado'=>1
                    );

                    $conn->prepare("UPDATE livro SET locado = :locado WHERE codigo = :codigo")->execute($dados);

                    echo "<script> successful(); </script>";

                } else {
                    
                    echo "<script> fail5(); </script>";

                }
                

            }

        ?>

        <div id="foot">
           © Copyright C7 Software by Publio S.
        </div>
        
    </body>
</html>
