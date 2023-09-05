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
                    <div id="button-main-menu">
                        LIVROS
                    </div>
                </a>
                <div id="white-line"></div>
                <a href="relatorios.php">
                    <div id="button-main-menu-now">
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
            <div id="title-label">RELATÓRIOS DE LOCAÇÕES POR TURMA</div>
            <form method="post" action="relatorios_logiccode.php">
                <div id="label">A partir de</div>
                <input type="date" id="text-field" required value="<?php date_default_timezone_set('America/Fortaleza'); echo date('Y-m-d') ?>" name="inicio"/>
                <div id="label">Série</div>
                <input type="number" min="1" max="3" id="text-field" placeholder="Informe a série que deseja pesquisar entre 1°, 2° ou 3°..." required name="serie" />
                <div id="label">Turma</div>
                <select id="combo-box" required name="turma">
                    <option value="a">A</option>
                    <option value="b">B</option>
                    <option value="c">C</option>
                    <option value="d">D</option>
                </select>
                <div id="label">Tipo</div>
                <select id="combo-box" required name="tipo">
                    <option value="1">Em atraso</option>
                    <option value="2">Ativas</option>
                    <option value="3">Inativas</option>
                    <option value="4">Todas</option>
                </select>
                <input type="submit" id="button-submit" value="CONFIRMAR"/>
            </form>
        </div>
        
        <div id="foot">
           © Copyright C7 Software by Publio S.
        </div>
        
    </body>
</html>