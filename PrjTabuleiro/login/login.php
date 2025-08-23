<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h1 class="titulo">Login</h1>


        <form action="loginConsulta.php" method="get" class="formualario">
            <p class="textinho">Seja muito bem vindo de volta!</p>

            <input type="email" name="email" id="email" placeholder="Digite aqui o seu Email">
            <br />

            <input type="password" name="senha" id="senha" placeholder="Digite aqui a sua senha">
            <br />

            <button type="submit" class="botao">Entrar</button>
            
            <div class="links">
                <p class="textCad">Não tem cadastro ainda? <a href="#">Clique aqui</a></p>
                <p class="textSenha">Esqueceu sua senha? <a href="#">Clique aqui</a></p>
            </div>
        </form>


    </div>
</body>
</html>