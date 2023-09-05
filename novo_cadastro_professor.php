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
                <div id="button-sub-menu-active">
                    Novo coordenador
                </div>
            </a>
            <a href="consultar_cadastro.php">
                <div id="button-sub-menu">
                    Consultar
                </div>
            </a>
            <div id="black-line"></div>
            <div id="title-label">NOVO CADASTRO DE COORDENADOR</div>
            <form method="post" action="novo_cadastro_professor_logiccode.php">
                <div id="label">Nome</div>
                <input type="text" id="text-field" placeholder="Informe o nome do coordenador..." required name="nome" />
                <div id="label">Código da categoria para controle</div>
                <input type="number" id="text-field" placeholder="Informe o código da categoría de livros que o coordenador irá controlar..." required name="categoria_livros" />
                <div id="label">Senha</div>
                <input type="password" id="text-field" placeholder="Informe a senha do coordenador..." required name="senha" />
                <div id="label">Confirmar senha</div>
                <input type="password" id="text-field" placeholder="Confirme a senha do coordenador..." required name="confirmacao_senha" />
                <input type="submit" id="button-submit" value="CONFIRMAR"/>
            </form>
        </div>
        
        <div id="foot">
           © Copyright C7 Software by Publio S.
        </div>
        
    </body>
</html>