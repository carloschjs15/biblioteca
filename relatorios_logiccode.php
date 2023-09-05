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
        <link href="css/relatorios.css" rel="stylesheet">
        <link rel="stylesheet" href="fonts/style.css" type="text/css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="fonts/segoi-ui.css">
        <script type="text/javascript">
            function imprimir() {
                print();
            }
        </script>
    </head>
    <body>
        
        <div id="print" onclick="imprimir()"></div>

        <div id="title">
            EEEP Dr. José Alves da Silveira - Biblioteca
        </div>
        <div id="sub-title">
            Relatório de Locações por Turma
        </div>

        <div id="content">

            <?php

                //Chama o arquivo de conexão
                require('conecta_db.php');

            ?>

            <?php

                $inicio = $_POST['inicio'];
                $serie = $_POST['serie'];
                $turma = $_POST['turma'];
                $tipo = $_POST['tipo'];

                if ($tipo == 1) {

                    $sql = "SELECT * FROM `locacao` WHERE `data_final` < curdate() AND `estado` = 1 Order by data_inicial ASC";
                    $result = $conn->query($sql);

                    $confirmacao = false;

                    echo "<table id='table' style='overflow-y:scroll' border='1'>";
                        echo "<thead id='table-header' >";
                            echo "<tr>";
                                echo "<th>Turma</th>";
                                echo "<th>Aluno</th>";
                                echo "<th>Matrícula</th>";
                                echo "<th>Livro</th>";
                                echo "<th>Código</th>";
                                echo "<th>Início</th>";
                                echo "<th>Término</th>";
                                echo "<th>Estado</th>";
                                echo "<th>Observação</th>";
                            echo "</tr>";
                        echo "</thead>";
                        echo "<tbody id='table-content'>";

                    foreach ($result as $value) {

                        $matricula_aluno = $value['matricula'];

                        $flat_result = $conn->query("SELECT * FROM `pessoa` WHERE `matricula` = $matricula_aluno");

                        foreach ($flat_result as $flat_value) {
                            
                            if ($flat_value['serie'] == $serie && $flat_value['turma'] == $turma) {
                                
                                $confirmacao = true;

                            }

                        }

                        if ($confirmacao == true && strtotime($value['data_inicial']) >= strtotime($inicio)) {

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
                                    echo $turma;
                                echo "</td>";
                                echo "<td>";
                                    echo $nome;
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

                            echo "</tr>";     

                        }

                    }

                        echo "</tbody>";
                    echo "</table>";

                } else if ($tipo == 2) {
                    
                    $sql = "SELECT * FROM `locacao` WHERE `data_final` > curdate() AND `estado` = 1 Order by data_inicial ASC";
                    $result = $conn->query($sql);

                    $confirmacao = false;

                    echo "<table id='table' style='overflow-y:scroll' border='1'>";
                        echo "<thead id='table-header' >";
                            echo "<tr>";
                                echo "<th>Turma</th>";
                                echo "<th>Aluno</th>";
                                echo "<th>Matrícula</th>";
                                echo "<th>Livro</th>";
                                echo "<th>Código</th>";
                                echo "<th>Início</th>";
                                echo "<th>Término</th>";
                                echo "<th>Estado</th>";
                                echo "<th>Observação</th>";
                            echo "</tr>";
                        echo "</thead>";
                        echo "<tbody id='table-content'>";

                    foreach ($result as $value) {

                        $matricula_aluno = $value['matricula'];

                        $flat_result = $conn->query("SELECT * FROM `pessoa` WHERE `matricula` = $matricula_aluno");

                        foreach ($flat_result as $flat_value) {
                            
                            if ($flat_value['serie'] == $serie && $flat_value['turma'] == $turma) {
                                
                                $confirmacao = true;

                            }

                        }

                        if ($confirmacao == true && strtotime($value['data_inicial']) >= strtotime($inicio)) {

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
                                    echo $turma;
                                echo "</td>";
                                echo "<td>";
                                    echo $nome;
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

                            echo "</tr>";     

                        }

                    }

                        echo "</tbody>";
                    echo "</table>";

                } else if ($tipo == 3) {
                   
                                        $sql = "SELECT * FROM `locacao` WHERE `estado` = 0 Order by data_inicial ASC";
                    $result = $conn->query($sql);

                    $confirmacao = false;

                    echo "<table id='table' style='overflow-y:scroll' border='1'>";
                        echo "<thead id='table-header' >";
                            echo "<tr>";
                                echo "<th>Turma</th>";
                                echo "<th>Aluno</th>";
                                echo "<th>Matrícula</th>";
                                echo "<th>Livro</th>";
                                echo "<th>Código</th>";
                                echo "<th>Início</th>";
                                echo "<th>Término</th>";
                                echo "<th>Estado</th>";
                                echo "<th>Observação</th>";
                            echo "</tr>";
                        echo "</thead>";
                        echo "<tbody id='table-content'>";

                    foreach ($result as $value) {

                        $matricula_aluno = $value['matricula'];

                        $flat_result = $conn->query("SELECT * FROM `pessoa` WHERE `matricula` = $matricula_aluno");

                        foreach ($flat_result as $flat_value) {
                            
                            if ($flat_value['serie'] == $serie && $flat_value['turma'] == $turma) {
                                
                                $confirmacao = true;

                            }

                        }

                        if ($confirmacao == true && strtotime($value['data_inicial']) >= strtotime($inicio)) {

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
                                    echo $turma;
                                echo "</td>";
                                echo "<td>";
                                    echo $nome;
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

                            echo "</tr>";     

                        }

                    }

                        echo "</tbody>";
                    echo "</table>";

                } else if ($tipo == 4) {
                   
                    $sql = "SELECT * FROM `locacao` Order by data_inicial ASC";
                    $result = $conn->query($sql);

                    $confirmacao = false;

                    echo "<table id='table' style='overflow-y:scroll' border='1'>";
                        echo "<thead id='table-header' >";
                            echo "<tr>";
                                echo "<th>Turma</th>";
                                echo "<th>Aluno</th>";
                                echo "<th>Matrícula</th>";
                                echo "<th>Livro</th>";
                                echo "<th>Código</th>";
                                echo "<th>Início</th>";
                                echo "<th>Término</th>";
                                echo "<th>Estado</th>";
                                echo "<th>Observação</th>";
                            echo "</tr>";
                        echo "</thead>";
                        echo "<tbody id='table-content'>";

                    foreach ($result as $value) {

                        $matricula_aluno = $value['matricula'];

                        $flat_result = $conn->query("SELECT * FROM `pessoa` WHERE `matricula` = $matricula_aluno");

                        foreach ($flat_result as $flat_value) {
                            
                            if ($flat_value['serie'] == $serie && $flat_value['turma'] == $turma) {
                                
                                $confirmacao = true;

                            }

                        }

                        if ($confirmacao == true && strtotime($value['data_inicial']) >= strtotime($inicio)) {

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
                                    echo $turma;
                                echo "</td>";
                                echo "<td>";
                                    echo $nome;
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

                            echo "</tr>";     

                        }

                    }

                        echo "</tbody>";
                    echo "</table>";

                }
                

            ?>

        </div>
        
    </body>
</html>
