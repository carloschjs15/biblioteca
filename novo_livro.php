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
        
        <div id="content">
            <a href="novo_livro.php">
                <div id="button-sub-menu-active">
                    Novo
                </div>
            </a>
            <a href="consultar_livros.php">
                <div id="button-sub-menu">
                    Consultar
                </div>
            </a>
            <div id="black-line"></div>
            <div id="title-label">NOVO CADASTRO DE LIVRO</div>
            <form method="post" action="novo_livro_logiccode.php">
                <div id="label">Nome</div>
                <input type="text" id="text-field" placeholder="Informe o nome do livro..." required name="nome" />
                <div id="label">Autor</div>
                <input type="text" id="text-field" placeholder="Informe o nome do autor do livro..." required name="autor" />
                <div id="label">Código da categoria</div>
                <input type="number" id="text-field" placeholder="Informe o código da categoria do livro..." required name="codigo_categoria" />
                <div id="label">Código do livro</div>
                <input type="number" id="text-field" placeholder="Informe o código do livro..." required name="codigo" />
                <div id="label">Tipo de livro</div>
                <select id="combo-box" name="tipo" required>
                    <option value="0">Comum</option>
                    <option value="1">Técnico</option>
                </select>
                <input type="submit" id="button-submit" value="CONFIRMAR"/>
            </form>
        </div>
        
        <div id="foot">
           © Copyright C7 Software by Publio S.
        </div>
        
    </body>
</html>