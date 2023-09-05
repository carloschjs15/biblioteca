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
            
            function successful1() {
                jAlert('Aluno editado com sucesso!', 'Atenção', function(r) {
                    if(r) {
                        location.href = "consultar_cadastro.php";
                    }
                });
            }
            function fail1() {
                jAlert('Já existe um aluno cadastrado com essa matrícula!', 'Erro', function(r) {
                    if(r) {
                        location.href = "consultar_cadastro.php";
                    }
                });
            }

            function successful2() {
                jAlert('Professor editado com sucesso!', 'Atenção', function(r) {
                    if(r) {
                        location.href = "consultar_cadastro.php";
                    }
                });
            }
            function fail2() {
                jAlert('As senhas não correspondem!', 'Erro', function(r) {
                    if(r) {
                        location.href = "consultar_cadastro.php";
                    }
                });
            }

            function fail() {
                jAlert('Informe um código numérico válido!', 'Erro', function(r) {
                    if(r) {
                        location.href = "consultar_cadastro.php";
                    }
                });
            }

            function deleteConfirmed1() {
                jAlert('Aluno excluido com sucesso!', 'Atenção', function(r) {
                    if(r) {
                        location.href = "consultar_cadastro.php";
                    }
                });
            }

            function deleteConfirmed2() {
                jAlert('Professor excluido com sucesso!', 'Atenção', function(r) {
                    if(r) {
                        location.href = "consultar_cadastro.php";
                    }
                });
            }

        </script>
        <script type="text/javascript">
            
            function loadWindowEdit1() {

                $(document).ready(function(){
                 
                    var id = "#edit-window1";
                 
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
                        $("#edit-window1").hide();
                    });
                 
                    $('.close').click(function(ev){
                        ev.preventDefault();
                        $("#mask").hide();
                        $("#edit-window1").hide();
                    });

                });

            }

            function loadWindowEdit2() {

                $(document).ready(function(){
                 
                    var id = "#edit-window2";
                 
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
                        $("#edit-window2").hide();
                    });
                 
                    $('.close').click(function(ev){
                        ev.preventDefault();
                        $("#mask").hide();
                        $("#edit-window2").hide();
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
                    <div id="button-main-menu-now">
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
            <a href="novo_cadastro_aluno.php">
                <div id="button-sub-menu">
                    Novo aluno
                </div>
            </a>
            <a href="novo_cadastro_professor.php">
                <div id="button-sub-menu">
                    Novo coordenador
                </div>
            </a>
            <a href="consultar_cadastro.php">
                <div id="button-sub-menu-active">
                    Consultar
                </div>
            </a>
            <div id="black-line"></div>
            <div id="title-label">CONSULTAR CADASTRO</div>
            <form method="post" action="consultar_cadastro.php">
                <div id="label">Pesquisar...</div>
                <input type="text" id="text-field" placeholder="Informe o que deseja pesquisar..." name="pesquisa" />
                <div id="label">Por...</div>
                <select id="combo-box" required name="tipo">
                    <option value="1">Nome de aluno</option>
                    <option value="2">Matrícula de aluno</option>
                    <option value="3">Nome de professor</option>
                    <option value="4">Código de professor</option>
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

                        $sql = "SELECT * FROM `pessoa` WHERE `nome` LIKE '$pesquisa%' Order by matricula";
                        $result = $conn->query($sql);

                        echo "<table id='table' style='overflow-y:scroll' border='1'>";
                            echo "<thead id='table-header' >";
                                echo "<tr>";
                                    echo "<th>Matrícula</th>";
                                    echo "<th>Nome</th>";
                                    echo "<th>Série</th>";
                                    echo "<th>Turma</th>";
                                    echo "<th>Editar</th>";
                                    echo "<th>Excluir</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody id='table-content'>";
                                foreach ($result as $value) {
                                    echo "<tr>";
                                        echo "<td>";
                                            echo $value['matricula'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $value['nome'];
                                        echo "</td>";
                                        echo "<td>";
                                            if($value['serie'] < 2000) {

                                                echo $value['serie']."º";

                                            } else {

                                                echo "3º - ".$value['serie'];

                                            }
                                        echo "</td>";
                                        echo "<td>";
                                            echo $value['turma'];
                                        echo "</td>";
                                        echo "<td>";
                                            if($value['serie'] < 2000) {

                                                echo "<form method='post' action=''>";
                                                    echo "<input type='text' hidden name='matricula' value='";
                                                        echo $value['matricula'];
                                                    echo "'>";
                                                    echo "<input type='submit' id='button-edit' value='Editar' name='enviar-1'>";
                                                echo "</form>";

                                            } else {

                                                echo "Função indisponível";
                                                
                                            }
                                        echo "</td>";
                                        echo "<td>";
                                            if($value['serie'] < 2000) {

                                                echo "<form method='post' action=''>";
                                                    echo "<input type='text' hidden name='matricula' value='";
                                                        echo $value['matricula'];
                                                    echo "'>";
                                                    echo "<input type='submit' id='button-delete' name='enviar-2' value='Excluir'>";
                                                echo "</form>";

                                            } else {

                                                echo "Função indisponível";

                                            }
                                        echo "</td>";
                                    echo "</tr>";
                                }
                            echo "</tbody>";
                        echo "</table>";

                } else if($tipo == 2) {

                    try {

                        echo "<div id='black-line'></div>";

                        $sql = "SELECT * FROM `pessoa` WHERE `matricula` = $pesquisa Order by matricula";
                        $result = $conn->query($sql);

                        echo "<table id='table' style='overflow-y:scroll' border='1'>";
                            echo "<thead id='table-header' >";
                                echo "<tr>";
                                    echo "<th>Matrícula</th>";
                                    echo "<th>Nome</th>";
                                    echo "<th>Série</th>";
                                    echo "<th>Turma</th>";
                                    echo "<th>Editar</th>";
                                    echo "<th>Excluir</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody id='table-content'>";
                                foreach ($result as $value) {
                                    echo "<tr>";
                                        echo "<td>";
                                            echo $value['matricula'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $value['nome'];
                                        echo "</td>";
                                        echo "<td>";
                                            if($value['serie'] < 2000) {

                                                echo $value['serie']."º";

                                            } else {

                                                echo "3º - ".$value['serie'];
                                                
                                            }
                                        echo "</td>";
                                        echo "<td>";
                                            echo $value['turma'];
                                        echo "</td>";
                                        echo "<td>";
                                            if($value['serie'] < 2000) {

                                                echo "<form method='post' action=''>";
                                                    echo "<input type='text' hidden name='matricula' value='";
                                                        echo $value['matricula'];
                                                    echo "'>";
                                                    echo "<input type='submit' id='button-edit' value='Editar' name='enviar-1'>";
                                                echo "</form>";

                                            } else {

                                                echo "Função indisponível";
                                                
                                            }
                                        echo "</td>";
                                        echo "<td>";
                                            if($value['serie'] < 2000) {

                                                echo "<form method='post' action=''>";
                                                    echo "<input type='text' hidden name='matricula' value='";
                                                        echo $value['matricula'];
                                                    echo "'>";
                                                    echo "<input type='submit' id='button-delete' name='enviar-2' value='Excluir'>";
                                                echo "</form>";

                                            } else {

                                                echo "Função indisponível";

                                            }
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

                        $sql = "SELECT * FROM `professor` WHERE `nome` LIKE '$pesquisa%' Order by id";
                        $result = $conn->query($sql);

                        echo "<table id='table' style='overflow-y:scroll' border='1'>";
                            echo "<thead id='table-header' >";
                                echo "<tr>";
                                    echo "<th>Código</th>";
                                    echo "<th>Nome</th>";
                                    echo "<th>Categoria de controle</th>";
                                    echo "<th>Editar</th>";
                                    echo "<th>Excluir</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody id='table-content'>";
                                foreach ($result as $value) {
                                    echo "<tr>";
                                        echo "<td>";
                                            echo $value['id'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $value['nome'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $value['categoria_livros'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo "<form method='post' action=''>";
                                                echo "<input type='text' hidden name='codigo' value='";
                                                    echo $value['id'];
                                                echo "'>";
                                                echo "<input type='submit' id='button-edit' value='Editar' name='enviar-3'>";
                                            echo "</form>";
                                        echo "</td>";
                                        echo "<td>";
                                            echo "<form method='post' action=''>";
                                                echo "<input type='text' hidden name='codigo' value='";
                                                    echo $value['id'];
                                                echo "'>";
                                                echo "<input type='submit' id='button-delete' name='enviar-4' value='Excluir'>";
                                            echo "</form>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                            echo "</tbody>";
                        echo "</table>";

                } else if($tipo == 4) {

                    try {

                        echo "<div id='black-line'></div>";

                        $sql = "SELECT * FROM `professor` WHERE `id` = $pesquisa Order by id";
                        $result = $conn->query($sql);

                        echo "<table id='table' style='overflow-y:scroll' border='1'>";
                            echo "<thead id='table-header' >";
                                echo "<tr>";
                                    echo "<th>Código</th>";
                                    echo "<th>Nome</th>";
                                    echo "<th>Categoria de controle</th>";
                                    echo "<th>Editar</th>";
                                    echo "<th>Excluir</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody id='table-content'>";
                                foreach ($result as $value) {
                                    echo "<tr>";
                                        echo "<td>";
                                            echo $value['id'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $value['nome'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $value['categoria_livros'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo "<form method='post' action=''>";
                                                echo "<input type='text' hidden name='codigo' value='";
                                                    echo $value['id'];
                                                echo "'>";
                                                echo "<input type='button' id='button-edit' value='Editar' name='enviar-3'>";
                                            echo "</form>";
                                        echo "</td>";
                                        echo "<td>";
                                            echo "<form method='post' action=''>";
                                                echo "<input type='text' hidden name='codigo' value='";
                                                    echo $value['id'];
                                                echo "'>";
                                                echo "<input type='button' id='button-delete' name='enviar-4' value='Excluir'";
                                            echo "</form>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                            echo "</tbody>";
                        echo "</table>";

                    } catch (Exception $e) {

                        echo "<script> fail(); </script>"; 

                    }

                }

            }

        ?>

        </div>

        <!-- Executa quando o botão de editar é clicado -->
        <?php

            if(isset($_POST['enviar-1'])) {

                $matricula = $_POST['matricula'];

                $sql = "SELECT * FROM `pessoa` WHERE `matricula` = $matricula";
                $result = $conn->query($sql);

                foreach ($result as $value) {
                    
                    $nome = $value['nome'];
                    $serie = $value['serie'];

                    $turmaA = "";
                    $turmaB = "";
                    $turmaC = "";
                    $turmaD = "";

                    if($value['turma'] == "a") {

                        $turmaA = "selected";

                    } else if($value['turma'] == "b") {

                        $turmaB = "selected";

                    } else if($value['turma'] == "c") {

                        $turmaC = "selected";

                    } else if($value['turma'] == "d") {

                        $turmaD = "selected";

                    }

                    $matricula = $value['matricula'];

                    $id = $value['id'];

                }

                echo "<script> loadWindowEdit1(); </script>";

            }

        ?>

        <!-- Executa quando o botão de editar é clicado -->
        <?php

            if(isset($_POST['enviar-3'])) {

                $codigo = $_POST['codigo'];

                $sql = "SELECT * FROM `professor` WHERE `id` = $codigo";
                $result = $conn->query($sql);

                foreach ($result as $value) {
                    
                    $nome = $value['nome'];
                    $categoria_livros = $value['categoria_livros'];
                    $codigo = $value['id'];
                    $senha = $value['senha'];

                }

                echo "<script> loadWindowEdit2(); </script>";

            }

        ?>

        <div class="window" id="edit-window1">
            <div id="title-window">* EDITAR ALUNO</div>
            <a href="#" class="close">
                <div id="close">X</div>
            </a>
            <div id="black-line"></div>
            <form method="post" action="">
                <input type="text" name="id" value="<?= $id ?>" hidden></input>
                <div id="label">Nome</div>
                <input type="text" id="text-field" placeholder="Informe o nome do aluno..." required name="nome" value="<?= $nome ?>" />
                <div id="label">Série</div>
                <input type="number" min="1" max="3" id="text-field" placeholder="Informe a série do aluno entre 1°, 2° ou 3°..." required name="serie" value="<?= $serie ?>" />
                <div id="label">Turma</div>
                <select id="combo-box" required name="turma">
                    <option value="a" <?php echo $turmaA; ?> >A</option>
                    <option value="b" <?php echo $turmaB; ?> >B</option>
                    <option value="c" <?php echo $turmaC; ?> >C</option>
                    <option value="d" <?php echo $turmaD; ?> >D</option>
                </select>
                <div id="label">Matrícula</div>
                <input type="number" id="text-field" placeholder="Informe a matrícula do aluno..." required name="matricula" value="<?= $matricula ?>" />
                <input type="submit" id="button-submit" value="CONFIRMAR" name="button_edit1" />
            </form>
        </div>

        <div class="window" id="edit-window2">
            <div id="title-window">* EDITAR PROFESSOR</div>
            <a href="#" class="close">
                <div id="close">X</div>
            </a>
            <div id="black-line"></div>
            <form method="post" action="">
                <input type="text" name="codigo" value="<?= $codigo ?>" hidden></input>
                <div id="label">Nome</div>
                <input type="text" id="text-field" placeholder="Informe o nome do aluno..." required name="nome" value="<?= $nome ?>" />
                <div id="label">Código da categoria para controle</div>
                <input type="number" id="text-field" placeholder="Informe o código da categoría de livros que o professor irá controlar..." required name="categoria_livros" value="<?= $categoria_livros ?>" />
                <div id="label">Senha</div>
                <input type="password" id="text-field" placeholder="Informe a senha do professor..." required name="senha" value="<?= $senha ?>" />
                <div id="label">Confirmar senha</div>
                <input type="password" id="text-field" placeholder="Confirme a senha do professor..." required name="confirmacao_senha" value="<?= $senha ?>" />
                <input type="submit" id="button-submit" value="CONFIRMAR" name="button_edit2"/>
            </form>
        </div>

        <!-- mascara para cobrir formulário da janela secundária -->  
        <div id="mask" class="mask"></div>

        <?php

            if (isset($_POST['button_edit1'])) {
                
                $id = $_POST['id'];
                $nome = $_POST['nome'];
                $serie = $_POST['serie'];
                $turma = $_POST['turma'];
                $matricula = $_POST['matricula'];

                $sql = $conn->query('SELECT * FROM pessoa WHERE matricula = ' . $conn->quote($matricula) . 'and id !=' . $conn->quote($id));
                $row = $sql->fetchColumn();

                if($row < 1){
        
                    $dados = array(
                        'nome'=>$nome,
                        'serie'=>$serie,
                        'turma'=>$turma,
                        'matricula'=>$matricula,
                        'id'=>$id
                    );

                    $conn->prepare("UPDATE pessoa SET nome = :nome,serie = :serie,turma = :turma, matricula = :matricula WHERE id = :id")->execute($dados);
                    unset($conn);

                    echo "<script> successful1(); </script>";

                } else {

                    echo "<script> fail1(); </script>";
                
                }

            }

        ?>

        <?php

            if (isset($_POST['enviar-2'])) {

                $matricula = $_POST['matricula'];

                $sql = "DELETE FROM pessoa WHERE matricula = $matricula";
                $conn->query($sql);

                echo "<script> deleteConfirmed1() </script>";

            }

        ?>

        <?php

            if (isset($_POST['button_edit2'])) {

                $id = $_POST['codigo'];
                $nome = $_POST['nome'];
                $categoria_livros = $_POST['categoria_livros'];
                $senha = $_POST['senha'];
                $confirmacao_senha = $_POST['confirmacao_senha'];
        
                if($senha == $confirmacao_senha) {

                    $dados = array(
                        'nome'=>$nome,
                        'categoria_livros'=>$categoria_livros,
                        'senha'=>$senha,
                        'codigo'=>$id
                    );

                    $conn->prepare("UPDATE professor SET nome = :nome ,categoria_livros = :categoria_livros, senha = :senha WHERE id = :codigo")->execute($dados);
                    unset($conn);

                    echo "<script> successful2(); </script>";

                } else {

                    echo "<script> fail2(); </script>";

                }


            }
            

        ?>

        <?php

            if (isset($_POST['enviar-4'])) {

                $codigo = $_POST['codigo'];

                $sql = "DELETE FROM professor WHERE id = $codigo";
                $conn->query($sql);

                echo "<script> deleteConfirmed2() </script>";

            }

        ?>

        <div id="foot">
           © Copyright C7 Software by Publio S.
        </div>
        
    </body>
</html>