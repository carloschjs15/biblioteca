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
                jAlert('Locação finalizada com sucesso!', 'Atenção', function(r) {
                    if(r) {
                        location.href = "consultar_locacoes.php";
                    }
                });
            }

            function fail() {
                jAlert('Informe um código numérico válido!', 'Erro', function(r) {
                    if(r) {
                        location.href = "consultar_locacoes.php";
                    }
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
                <div id="button-sub-menu">
                    Nova
                </div>
            </a>
            <a href="consultar_locacoes.php">
                <div id="button-sub-menu-active">
                    Consultar
                </div>
            </a>
            <div id="black-line"></div>
            <div id="title-label">CONSULTAR LOCAÇÕES</div>
            <form method="post" action="">
                <div id="label">Pesquisar...</div>
                <input type="number" id="text-field" placeholder="Digite o que deseja pesquisar..." name="pesquisa" />
                <div id="label">Por...</div>
                <select id="combo-box" required name="tipo">
                    <option value="1">Código do livro</option>
                    <option value="2">Matrícula do aluno</option>
                    <option value="3">Devoluções para hoje</option>
                    <option value="4">Devoluções em atraso</option>
                </select>
                <input type="submit" id="button-submit" value="PROCURAR" name="enviar" />
            </form>

            <?php

                //Chama o arquivo de conexão
                require('conecta_db.php');

            ?>

            <?php

                if (isset($_POST['enviar'])) {
                    
                    $tipo = $_POST['tipo'];
                    $pesquisa = $_POST['pesquisa'];

                    if($tipo == 1) {
                        
                        try {

                            echo "<div id='black-line'></div>";

                            $sql = "SELECT * FROM `locacao` WHERE `codigo` = $pesquisa Order by data_inicial DESC";
                            $result = $conn->query($sql);

                            echo "<table id='table' style='overflow-y:scroll' border='1'>";
                                echo "<thead id='table-header' >";
                                    echo "<tr>";
                                        echo "<th>Aluno</th>";
                                        echo "<th>Turma</th>";
                                        echo "<th>Matrícula</th>";
                                        echo "<th>Livro</th>";
                                        echo "<th>Código</th>";
                                        echo "<th>Início</th>";
                                        echo "<th>Término</th>";
                                        echo "<th>Estado</th>";
                                        echo "<th>Observação</th>";
                                        echo "<th>Finalizar</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody id='table-content'>";
                                    foreach ($result as $value) {

                                        echo "<tr>";

                                            $matricula = $value['matricula'];

                                            $result_secondary = $conn->query("SELECT * FROM `pessoa` WHERE `matricula` = $matricula");

                                            $nome = "";
                                            $turma = "";
                                            $matricula = "";

                                            foreach ($result_secondary as $value_secondary) {
                                                    
                                                $nome = $value_secondary['nome'];

                                                if($value_secondary['serie'] < 2000) {

                                                    $turma = $value_secondary['serie']."° ".$value_secondary['turma'];

                                                } else {

                                                    $turma = "3° ".$value_secondary['turma']." - ".$value_secondary['serie'];

                                                }
                                                $matricula = $value_secondary['matricula'];

                                            }

                                            echo "<td>";
                                                echo $nome;
                                            echo "</td>";
                                            echo "<td>";
                                                echo $turma;
                                            echo "</td>";
                                            echo "<td>";
                                                echo $matricula;
                                            echo "</td>";

                                            $codigo = $value['codigo'];

                                            $result_secondary = $conn->query("SELECT * FROM `livro` WHERE `codigo` = $codigo");

                                            $nome = "";
                                            $codigo = "";

                                            foreach ($result_secondary as $value_secondary) {
                                                    
                                                $nome = $value_secondary['nome'];
                                                $codigo = $value_secondary['codigo'];

                                            }

                                            echo "<td>";
                                                echo $nome;
                                            echo "</td>";
                                            echo "<td>";
                                                echo $codigo;
                                            echo "</td>";

                                            echo "<td>";
                                                echo date('d/m/Y', strtotime($value['data_inicial']));
                                            echo "</td>";
                                            echo "<td>";
                                                echo date('d/m/Y', strtotime($value['data_final']));
                                            echo "</td>";

                                            echo "<td>";

                                                if ($value['estado'] == 0) {
                                                        
                                                    echo "Finalizada";

                                                } else {
                                                        
                                                    if (strtotime($value['data_final']) < date('Y-m-d')) {
                                                            
                                                        echo "Em atraso";

                                                    } else {
                                                            
                                                        echo "Ativa";

                                                    }

                                                }

                                            echo "</td>";

                                            $observacao = "";

                                            if ($value['permissao'] == 0) {
                                                
                                                $observacao = "Nenhuma";

                                            } else {

                                                $permissao = $value['permissao'];

                                                $result_secondary = $conn->query("SELECT * FROM `professor` WHERE `id` = $permissao");

                                                foreach ($result_secondary as $value_secondary) {

                                                   $observacao = "Permitido por: ".$value_secondary['nome'];

                                                }
                                               
                                            }
                                            
                                            echo "<td>";
                                                echo $observacao;
                                            echo "</td>";

                                            echo "<td>";

                                                if ($value['estado'] == 0) {
                                                    
                                                    echo "<center>***</center>";

                                                } else {

                                                    echo "<form method='post' action=''>";
                                                        echo "<input type='text' hidden name='id_locacao' value='";
                                                            echo $value['id'];
                                                        echo "'>";
                                                        echo "<input type='text' hidden name='codigo_livro' value='";
                                                            echo $value['codigo'];
                                                        echo "'>";
                                                        echo "<input type='submit' id='button-finalize' value='Finalizar' name='enviar-1'>";
                                                    echo "</form>";

                                                }

                                            echo "</td>";
                                        echo "</tr>";
                                    }
                                echo "</tbody>";
                            echo "</table>";

                        } catch (Exception $e) {

                            echo "<script> fail(); </script>"; 

                        }

                    } else if($tipo == 2) {
                        
                        try {

                            echo "<div id='black-line'></div>";

                            $sql = "SELECT * FROM `locacao` WHERE `matricula` = $pesquisa Order by data_inicial DESC";
                            $result = $conn->query($sql);

                            echo "<table id='table' style='overflow-y:scroll' border='1'>";
                                echo "<thead id='table-header' >";
                                    echo "<tr>";
                                        echo "<th>Aluno</th>";
                                        echo "<th>Turma</th>";
                                        echo "<th>Matrícula</th>";
                                        echo "<th>Livro</th>";
                                        echo "<th>Código</th>";
                                        echo "<th>Início</th>";
                                        echo "<th>Término</th>";
                                        echo "<th>Estado</th>";
                                        echo "<th>Observação</th>";
                                        echo "<th>Finalizar</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody id='table-content'>";
                                    foreach ($result as $value) {

                                        echo "<tr>";

                                            $matricula = $value['matricula'];

                                            $result_secondary = $conn->query("SELECT * FROM `pessoa` WHERE `matricula` = $matricula");

                                            $nome = "";
                                            $turma = "";
                                            $matricula = "";

                                            foreach ($result_secondary as $value_secondary) {
                                                    
                                                $nome = $value_secondary['nome'];
                                                $turma = $value_secondary['serie']."° ".$value_secondary['turma'];
                                                $matricula = $value_secondary['matricula'];

                                            }

                                            echo "<td>";
                                                echo $nome;
                                            echo "</td>";
                                            echo "<td>";
                                                echo $turma;
                                            echo "</td>";
                                            echo "<td>";
                                                echo $matricula;
                                            echo "</td>";

                                            $codigo = $value['codigo'];

                                            $result_secondary = $conn->query("SELECT * FROM `livro` WHERE `codigo` = $codigo");

                                            $nome = "";
                                            $codigo = "";

                                            foreach ($result_secondary as $value_secondary) {
                                                    
                                                $nome = $value_secondary['nome'];
                                                $codigo = $value_secondary['codigo'];

                                            }

                                            echo "<td>";
                                                echo $nome;
                                            echo "</td>";
                                            echo "<td>";
                                                echo $codigo;
                                            echo "</td>";

                                            echo "<td>";
                                                echo date('d/m/Y', strtotime($value['data_inicial']));
                                            echo "</td>";
                                            echo "<td>";
                                                echo date('d/m/Y', strtotime($value['data_final']));
                                            echo "</td>";

                                            echo "<td>";

                                                if ($value['estado'] == 0) {
                                                        
                                                    echo "Finalizada";

                                                } else {
                                                        
                                                    if (strtotime($value['data_final']) < date('Y-m-d')) {
                                                            
                                                        echo "Em atraso";

                                                    } else {
                                                            
                                                        echo "Ativa";

                                                    }

                                                }

                                            echo "</td>";

                                            $observacao = "";

                                            if ($value['permissao'] == 0) {
                                                
                                                $observacao = "Nenhuma";

                                            } else {

                                                $permissao = $value['permissao'];

                                                $result_secondary = $conn->query("SELECT * FROM `professor` WHERE `id` = $permissao");

                                                foreach ($result_secondary as $value_secondary) {

                                                   $observacao = "Permitido por: ".$value_secondary['nome'];

                                                }
                                               
                                            }
                                            
                                            echo "<td>";
                                                echo $observacao;
                                            echo "</td>";

                                            echo "<td>";

                                                if ($value['estado'] == 0) {
                                                    
                                                    echo "<center>***</center>";

                                                } else {

                                                    echo "<form method='post' action=''>";
                                                        echo "<input type='text' hidden name='id_locacao' value='";
                                                            echo $value['id'];
                                                        echo "'>";
                                                        echo "<input type='text' hidden name='codigo_livro' value='";
                                                            echo $value['codigo'];
                                                        echo "'>";
                                                        echo "<input type='submit' id='button-finalize' value='Finalizar' name='enviar-1'>";
                                                    echo "</form>";

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

                        $sql = "SELECT * FROM `locacao` WHERE `data_final` = curdate() AND `estado` = 1 Order by data_inicial DESC";
                        $result = $conn->query($sql);

                        echo "<table id='table' style='overflow-y:scroll' border='1'>";
                            echo "<thead id='table-header' >";
                                echo "<tr>";
                                    echo "<th>Aluno</th>";
                                    echo "<th>Turma</th>";
                                    echo "<th>Matrícula</th>";
                                    echo "<th>Livro</th>";
                                    echo "<th>Código</th>";
                                    echo "<th>Início</th>";
                                    echo "<th>Término</th>";
                                    echo "<th>Estado</th>";
                                    echo "<th>Observação</th>";
                                    echo "<th>Finalizar</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody id='table-content'>";
                                foreach ($result as $value) {

                                    echo "<tr>";

                                        $matricula = $value['matricula'];

                                        $result_secondary = $conn->query("SELECT * FROM `pessoa` WHERE `matricula` = $matricula");

                                        $nome = "";
                                        $turma = "";
                                        $matricula = "";

                                        foreach ($result_secondary as $value_secondary) {
                                                
                                            $nome = $value_secondary['nome'];
                                            $turma = $value_secondary['serie']."° ".$value_secondary['turma'];
                                            $matricula = $value_secondary['matricula'];

                                        }

                                        echo "<td>";
                                            echo $nome;
                                        echo "</td>";
                                        echo "<td>";
                                            echo $turma;
                                        echo "</td>";
                                        echo "<td>";
                                            echo $matricula;
                                        echo "</td>";

                                        $codigo = $value['codigo'];

                                        $result_secondary = $conn->query("SELECT * FROM `livro` WHERE `codigo` = $codigo");

                                        $nome = "";
                                        $codigo = "";

                                        foreach ($result_secondary as $value_secondary) {
                                                
                                            $nome = $value_secondary['nome'];
                                            $codigo = $value_secondary['codigo'];

                                        }

                                        echo "<td>";
                                            echo $nome;
                                        echo "</td>";
                                        echo "<td>";
                                            echo $codigo;
                                        echo "</td>";

                                        echo "<td>";
                                            echo date('d/m/Y', strtotime($value['data_inicial']));
                                        echo "</td>";
                                        echo "<td>";
                                            echo date('d/m/Y', strtotime($value['data_final']));
                                        echo "</td>";

                                        echo "<td>";

                                            if ($value['estado'] == 0) {
                                                    
                                                echo "Finalizada";

                                            } else {
                                                    
                                                if (strtotime($value['data_final']) < date('Y-m-d')) {
                                                        
                                                    echo "Em atraso";

                                                } else {
                                                        
                                                    echo "Ativa";

                                                }

                                            }

                                        echo "</td>";

                                        $observacao = "";

                                        if ($value['permissao'] == 0) {
                                            
                                            $observacao = "Nenhuma";

                                        } else {

                                            $permissao = $value['permissao'];

                                            $result_secondary = $conn->query("SELECT * FROM `professor` WHERE `id` = $permissao");

                                            foreach ($result_secondary as $value_secondary) {

                                               $observacao = "Permitido por: ".$value_secondary['nome'];

                                            }
                                           
                                        }
                                        
                                        echo "<td>";
                                            echo $observacao;
                                        echo "</td>";

                                        echo "<td>";

                                            if ($value['estado'] == 0) {
                                                
                                                echo "<center>***</center>";

                                            } else {

                                                echo "<form method='post' action=''>";
                                                    echo "<input type='text' hidden name='id_locacao' value='";
                                                        echo $value['id'];
                                                    echo "'>";
                                                    echo "<input type='text' hidden name='codigo_livro' value='";
                                                        echo $value['codigo'];
                                                    echo "'>";
                                                    echo "<input type='submit' id='button-finalize' value='Finalizar' name='enviar-1'>";
                                                echo "</form>";

                                            }

                                        echo "</td>";
                                    echo "</tr>";
                                }
                            echo "</tbody>";
                        echo "</table>";

                    } else if($tipo == 4) {
                        
                        echo "<div id='black-line'></div>";

                        $sql = "SELECT * FROM `locacao` WHERE `data_final` < curdate() AND `estado` = 1 Order by data_inicial DESC";
                        $result = $conn->query($sql);

                        echo "<table id='table' style='overflow-y:scroll' border='1'>";
                            echo "<thead id='table-header' >";
                                echo "<tr>";
                                    echo "<th>Aluno</th>";
                                    echo "<th>Turma</th>";
                                    echo "<th>Matrícula</th>";
                                    echo "<th>Livro</th>";
                                    echo "<th>Código</th>";
                                    echo "<th>Início</th>";
                                    echo "<th>Término</th>";
                                    echo "<th>Estado</th>";
                                    echo "<th>Observação</th>";
                                    echo "<th>Finalizar</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody id='table-content'>";
                                foreach ($result as $value) {

                                    echo "<tr>";

                                        $matricula = $value['matricula'];

                                        $result_secondary = $conn->query("SELECT * FROM `pessoa` WHERE `matricula` = $matricula");

                                        $nome = "";
                                        $turma = "";
                                        $matricula = "";

                                        foreach ($result_secondary as $value_secondary) {
                                                
                                            $nome = $value_secondary['nome'];
                                            $turma = $value_secondary['serie']."° ".$value_secondary['turma'];
                                            $matricula = $value_secondary['matricula'];

                                        }

                                        echo "<td>";
                                            echo $nome;
                                        echo "</td>";
                                        echo "<td>";
                                            echo $turma;
                                        echo "</td>";
                                        echo "<td>";
                                            echo $matricula;
                                        echo "</td>";

                                        $codigo = $value['codigo'];

                                        $result_secondary = $conn->query("SELECT * FROM `livro` WHERE `codigo` = $codigo");

                                        $nome = "";
                                        $codigo = "";

                                        foreach ($result_secondary as $value_secondary) {
                                                
                                            $nome = $value_secondary['nome'];
                                            $codigo = $value_secondary['codigo'];

                                        }

                                        echo "<td>";
                                            echo $nome;
                                        echo "</td>";
                                        echo "<td>";
                                            echo $codigo;
                                        echo "</td>";

                                        echo "<td>";
                                            echo date('d/m/Y', strtotime($value['data_inicial']));
                                        echo "</td>";
                                        echo "<td>";
                                            echo date('d/m/Y', strtotime($value['data_final']));
                                        echo "</td>";

                                        echo "<td>";

                                            if ($value['estado'] == 0) {
                                                    
                                                echo "Finalizada";

                                            } else {
                                                    
                                                if (strtotime($value['data_final']) < date('Y-m-d')) {
                                                        
                                                    echo "Em atraso";

                                                } else {
                                                        
                                                    echo "Ativa";

                                                }

                                            }

                                        echo "</td>";

                                        $observacao = "";

                                        if ($value['permissao'] == 0) {
                                            
                                            $observacao = "Nenhuma";

                                        } else {

                                            $permissao = $value['permissao'];

                                            $result_secondary = $conn->query("SELECT * FROM `professor` WHERE `id` = $permissao");

                                            foreach ($result_secondary as $value_secondary) {

                                               $observacao = "Permitido por: ".$value_secondary['nome'];

                                            }
                                           
                                        }
                                        
                                        echo "<td>";
                                            echo $observacao;
                                        echo "</td>";

                                        echo "<td>";

                                            if ($value['estado'] == 0) {
                                                
                                                echo "<center>***</center>";

                                            } else {

                                                echo "<form method='post' action=''>";
                                                    echo "<input type='text' hidden name='id_locacao' value='";
                                                        echo $value['id'];
                                                    echo "'>";
                                                    echo "<input type='text' hidden name='codigo_livro' value='";
                                                        echo $value['codigo'];
                                                    echo "'>";
                                                    echo "<input type='submit' id='button-finalize' value='Finalizar' name='enviar-1'>";
                                                echo "</form>";

                                            }

                                        echo "</td>";
                                    echo "</tr>";
                                }
                            echo "</tbody>";
                        echo "</table>";

                    }
                    
                }

            ?>

        </div>

        <?php

            if (isset($_POST['enviar-1'])) {
                
                $id_locacao = $_POST['id_locacao'];
                $codigo_livro = $_POST['codigo_livro'];

                $sql = "UPDATE `locacao` SET estado = 0 WHERE `id` = $id_locacao";
                $result = $conn->query($sql);

                $sql = "UPDATE `livro` SET locado = 0 WHERE `codigo` = $codigo_livro";
                $result = $conn->query($sql);

                echo "<script> successful(); </script>"; 

            }

        ?>

        <div id="foot">
           © Copyright C7 Software by Publio S.
        </div>
        
    </body>
</html>