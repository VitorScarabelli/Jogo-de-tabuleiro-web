<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <form action="cadusuario.php" method="post">
        <input type="text" name="nome">
        <input type="email" name="email">
        <input type="password" name="senha">
        <button type="submit">cadastrar</button>

    </form>

    <?php 
        include('../banco/conexao.php');
    ?>
</body>
</html>