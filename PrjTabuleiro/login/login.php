<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Login</title>
</head>
<body>
    <header>
        <div class="left">
            <a href="../Index/index.php"><img src="./KitComposiçãoLogin/svg/Botões/Back Button.svg" alt="" width="70px" height="70px"></img></a>
            <a href="../Index/index.php"><img src="./KitComposiçãoLogin/svg/Botões/Home Button.svg" alt="" width="70px" height="70px"></img></a>
        </div>
        <div class="right">
            <a href="#"><img src="./KitComposiçãoLogin/svg/Botões/Music Button.png" alt="" width="70px" height="70px"></img></a>
            <a href="#"><img src="./KitComposiçãoLogin/svg/Botões/Config Button.png" alt="" width="70px" height="70px"></img></a>
        </div>
    </header>
    <div class="container">
        <h1 class="titulo">Login</h1>
        <div class="quadrados">
            <form method="get" class="formulario">
                <label for="" class="email">Email:</label>
                <div class="primeiraCaixaTexto">
                    <input type="email" name="email" id="email" placeholder="@gmail.com">
                </div>
                <br />
                <label for="" class="senha">Senha:</label>
                <div class="caixaTexto">
                    <input type="password" name="senha" id="senha" placeholder="password">
                </div>
                <br />
                <div class="caixaBotao">
                    <button type="submit" class="botao">CONFIRMAR</button>
                </div>
            </form>
            <div class="links">
                <p class="textCadastro">Não possui uma conta ainda?</p> <a href="#">Criar uma</a>
            </div>
        </div>
    </div>
</body>
</html>
