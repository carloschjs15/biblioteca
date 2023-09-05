<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Biblioteca</title>
        <link href="css/login.css" rel="stylesheet">
        <link rel="stylesheet" href="fonts/style.css" type="text/css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="fonts/segoi-ui.css">
    </head>
    <body>
        <div id="title">
            <div id="logo-title"></div>
            Biblioteca E.P. Dr. José Alves
        </div>
        <div id="login-box">
            <div id="login-box-title">FAÇA LOGIN</div>
            <div id="line"></div>
            <form method="post" action="login_logiccode.php">
                <div id="label">Usuário</div>
                <input type="text" id="text-field" placeholder="Informe seu usuário..." required name="usuario" />
                <div id="label">Senha</div>
                <input type="password" id="text-field" placeholder="Informe sua senha..." required name="senha" />
                <input type="submit" id="button-submit" value="ENTRAR"/>
            </form>
        </div>
    </body>
</html>