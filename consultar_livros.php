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
        <script>

            var confirmation;

            function editSuccessful() {
                jAlert('Livro editado com sucesso!', 'Atenção', function(r) {
                    if(r) {
                        location.href = "consultar_livros.php";
                    }
                });
            }
            function fail() {
                jAlert('Informe um código válido!', 'Erro', function(r) {
                    if(r) {
                        location.href = "consultar_livros.php";
                    }
                });
            }
            function deleteConfirmed() {
                jAlert('Livro excluido com sucesso!', 'Atenção', function(r) {
                    if(r) {
                        location.href = "consultar_livros.php";
                    }
                });
            }
        </script>
        <script type="text/javascript">
            
            function loadWindowEdit() {

                $(document).ready(function(){
                 
                    var id = "#edit-window";
                 
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
                    <div id="button-main-menu">
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
                    <div id="button-main-menu-now">
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
        
        </div>

        <div id="content">
            <a href="novo_livro.php">
                <div id="button-sub-menu">
                    Novo
                </div>
            </a>
            <a href="consultar_livros.php">
                <div id="button-sub-menu-active">
                    Consultar
                </div>
            </a>
            <div id="black-line"></div>
            <div id="title-label">CONSULTAR LIVRO</div>
            <form method="post" action="consultar_livros.php">
                <div id="label">Pesquisar...</div>
                <input type="text" id="text-field" placeholder="Informe o que deseja pesquisar..." name="pesquisa" />
                <div id="label">Por...</div>
                <select id="combo-box" required name="tipo">
                    <option value="1">Nome de livro</option>
                    <option value="2">Código do livro</option>
                    <option value="3">Autor do livro</option>
                </select>
                <input type="submit" id="button-submit" value="PROCURAR" name="enviar" />
            </form>

            <?php
                //Chama o arquivo de conexão
                require('conecta_db.php');
            ?>

            <?php

                if(isset($_POST['enviar'])) {

                    $pesquisa = $_POST['pesquisa'];
                    $tipo = $_POST['tipo'];

                    if($tipo == 1) {

                        echo "<div id='black-line'></div>";

                        $sql = "SELECT * FROM `livro` WHERE `nome` LIKE '$pesquisa%' Order by codigo";
                        $result = $conn->query($sql);

                        echo "<table id='table' style='overflow-y:scroll' border='1'>";
                            echo "<thead id='table-header' >";
                                echo "<tr>";
                                    echo "<th>Código</th>";
                                    echo "<th>Nome</th>";
                                    echo "<th>Autor</th>";
                                    echo "<th>Categoria</th>";
                                    echo "<th>Tipo</th>";
                                    echo "<th>Estado</th>";
                                    echo "<th>Editar</th>";
                                    echo "<th>Excluir</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody id='table-content'>";
                                foreach ($result as $value) {
                                    echo "<tr>";
                                        echo "<td>";
                                            echo $value['codigo'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $value['nome'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $value['autor'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $value['categoria'];
                                        echo "</td>";
                                        echo "<td>";
                                            if($value['tecnico'] == 0){

                                                echo "Comum";
                                                
                                            } else {

                                                echo "Técnico";

                                            }
                                        echo "</td>";
                                        echo "<td>";
                                            if($value['locado'] == 0){

                                                echo "Livre";
                                                
                                            } else {

                                                echo "Locado";

                                            }
                                        echo "</td>";
                                        echo "<td>";
                                            echo "<form method='post' action='consultar_livros.php'>";
                                                echo "<input type='text' hidden name='codigo_livro' value='";
                                                    echo $value['codigo'];
                                                echo "'>";
                                                echo "<input type='submit' id='button-edit' value='Editar' name='enviar-1'>";
                                            echo "</form>";
                                        echo "</td>";
                                        echo "<td>";
                                            echo "<form method='post' action=''>";
                                                echo "<input type='text' hidden name='codigo_livro' value='";
                                                    echo $value['codigo'];
                                                echo "'>";
                                                echo "<input type='submit' id='button-delete' name='enviar-2' value='Excluir'>";
                                            echo "</form>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                            echo "</tbody>";
                        echo "</table>";

                    } else if($tipo == 2) {

                        try {

                            echo "<div id='black-line'></div>";

                            $sql = "SELECT * FROM `livro` WHERE `codigo` = $pesquisa Order by codigo";
                            $result = $conn->query($sql);

                            echo "<table id='table' style='overflow-y:scroll' border='1'>";
                            echo "<thead id='table-header' >";
                                echo "<tr>";
                                    echo "<th>Código</th>";
                                    echo "<th>Nome</th>";
                                    echo "<th>Autor</th>";
                                    echo "<th>Categoria</th>";
                                    echo "<th>Tipo</th>";
                                    echo "<th>Estado</th>";
                                    echo "<th>Editar</th>";
                                    echo "<th>Excluir</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody id='table-content'>";
                                foreach ($result as $value) {
                                    echo "<tr>";
                                        echo "<td>";
                                            echo $value['codigo'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $value['nome'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $value['autor'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $value['categoria'];
                                        echo "</td>";
                                        echo "<td>";
                                            if($value['tecnico'] == 0){

                                                echo "Comum";
                                                
                                            } else {

                                                echo "Técnico";

                                            }
                                        echo "</td>";
                                        echo "<td>";
                                            if($value['locado'] == 0){

                                                echo "Livre";
                                                
                                            } else {

                                                echo "Locado";

                                            }
                                        echo "</td>";
                                        echo "<td>";
                                            echo "<form method='post' action='consultar_livros.php'>";
                                                echo "<input type='text' hidden name='codigo_livro' value='";
                                                    echo $value['codigo'];
                                                echo "'>";
                                                echo "<input type='submit' id='button-edit' value='Editar' name='enviar-1'>";
                                            echo "</form>";
                                        echo "</td>";
                                        echo "<td>";
                                            echo "<form method='post' action=''>";
                                                echo "<input type='text' hidden name='codigo_livro' value='";
                                                    echo $value['codigo'];
                                                echo "'>";
                                                echo "<input type='submit' id='button-delete' name='enviar-2' value='Excluir'>";
                                            echo "</form>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                            echo "</tbody>";
                        echo "</table>";


                        } catch (Exception $e) {

                            echo "<script> fail(); </script>"; 

                        }
                            
                    } else if($tipo == 3) {

                        echo "<div id='black-line'></div>";

                        $sql = "SELECT * FROM `livro` WHERE `autor` LIKE '$pesquisa%' Order by codigo";
                        $result = $conn->query($sql);

                        echo "<table id='table' style='overflow-y:scroll' border='1'>";
                            echo "<thead id='table-header' >";
                                echo "<tr>";
                                    echo "<th>Código</th>";
                                    echo "<th>Nome</th>";
                                    echo "<th>Autor</th>";
                                    echo "<th>Categoria</th>";
                                    echo "<th>Tipo</th>";
                                    echo "<th>Estado</th>";
                                    echo "<th>Editar</th>";
                                    echo "<th>Excluir</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody id='table-content'>";
                                foreach ($result as $value) {
                                    echo "<tr>";
                                        echo "<td>";
                                            echo $value['codigo'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $value['nome'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $value['autor'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $value['categoria'];
                                        echo "</td>";
                                        echo "<td>";
                                            if($value['tecnico'] == 0){

                                                echo "Comum";
                                                
                                            } else {

                                                echo "Técnico";

                                            }
                                        echo "</td>";
                                        echo "<td>";
                                            if($value['locado'] == 0){

                                                echo "Livre";
                                                
                                            } else {

                                                echo "Locado";

                                            }
                                        echo "</td>";
                                        echo "<td>";
                                            echo "<form method='post' action='consultar_livros.php'>";
                                                echo "<input type='text' hidden name='codigo_livro' value='";
                                                    echo $value['codigo'];
                                                echo "'>";
                                                echo "<input type='submit' id='button-edit' value='Editar' name='enviar-1'>";
                                            echo "</form>";
                                        echo "</td>";
                                        echo "<td>";
                                            echo "<form method='post' action=''>";
                                                echo "<input type='text' hidden name='codigo_livro' value='";
                                                    echo $value['codigo'];
                                                echo "'>";
                                                echo "<input type='submit' id='button-delete' name='enviar-2' value='Excluir'>";
                                            echo "</form>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                            echo "</tbody>";
                        echo "</table>";

                    }

                }    

            ?>

        </div>
        
        <!-- Executa quando o botão de editar é clicado -->
        <?php

            if(isset($_POST['enviar-1'])) {

                $codigo_livro = $_POST['codigo_livro'];

                $sql = "SELECT * FROM `livro` WHERE `codigo` = $codigo_livro";
                $result = $conn->query($sql);

                $tecnico_true = "";
                $tecnico_false = "";

                foreach ($result as $value) {
                    
                    $nome = $value['nome'];
                    $autor = $value['autor'];
                    $categoria= $value['categoria'];
                    $codigo = $value['codigo'];

                    if ($value['tecnico'] == 0) {

                        $tecnico_false = "selected";

                    } else {
                        
                        $tecnico_true = "selected";
                    
                    }
                    

                }

                echo "<script> loadWindowEdit(); </script>";

            }

        ?>

        <div class="window" id="edit-window">
            <div id="title-window">* EDITAR LIVRO</div>
            <a href="#" class="close">
                <div id="close">X</div>
            </a>
            <div id="black-line"></div>
            <form method="post" action="">
                <div id="label">Nome</div>
                <input type="text" id="text-field" placeholder="Informe o nome do livro..." required name="nome" value="<?= $nome ?>" />
                <div id="label">Autor</div>
                <input type="text" id="text-field" placeholder="Informe o nome do autor do livro..." required name="autor" value="<?= $autor ?>" />
                <div id="label">Código da categoria</div>
                <input type="number" id="text-field" placeholder="Informe o código da categoria do livro..." required name="codigo_categoria" value="<?= $categoria ?>"/>
                <div id="label">Código do livro</div>
                <input type="number" id="text-field" placeholder="Informe o código do livro..." required name="codigo" value="<?= $codigo ?>" readonly/>
                <div id="label">Tipo de livro</div>
                <select id="combo-box" name="tipo" required>
                    <option value="0" <?php echo $tecnico_false; ?>>Comum</option>
                    <option value="1" <?php echo $tecnico_true; ?>>Técnico</option>
                </select>
                <input type="submit" id="button-submit" name="edit" value="CONFIRMAR"/>
            </form>
        </div>

        <!-- mascara para cobrir formulário da janela secundária -->  
        <div class="mask" id="mask"></div>

        <!-- Edita as informações de um livro -->
        <?php

            if(isset($_POST['edit'])) {

                $dados = array(
                    'nome'=>$_POST['nome'],
                    'autor'=>$_POST['autor'],
                    'categoria'=>$_POST['codigo_categoria'],
                    'codigo'=>$_POST['codigo']
                );

                $conn->prepare("UPDATE livro SET nome = :nome, autor = :autor, categoria = :categoria, codigo = :codigo WHERE codigo = :codigo")->execute($dados);

                echo "<script> editSuccessful(); </script>";

            }

        ?>

        <!-- Exclui um livro -->
        <?php

            if(isset($_POST['enviar-2'])) {

                $codigo_livro = $_POST['codigo_livro'];

                $sql = "DELETE FROM livro WHERE codigo = $codigo_livro";
                $conn->query($sql);

                echo "<script> deleteConfirmed() </script>";

            }

        ?>

        <div id="foot">
           © Copyright C7 Software by Publio S.
        </div>
        
    </body>
</html>