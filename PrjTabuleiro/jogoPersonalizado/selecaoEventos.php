<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escolher Eventos</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php 
        include_once("../banco/conexao.php"); 
        include_once("../includes/verificacao_session_usu.php");
    ?>

    <h1>Escolha os eventos para o próximo jogo:</h1>
    


    <form method="POST" action="eventosEscolhidos.php"> 
        <?php
            $stmt = $pdo->query("SELECT * FROM tbevento");
            while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                echo "<label>";
                echo "<input type='checkbox' name='eventos_selecionados[]' value='" . $row['idEvento'] . "'>";
                echo " <strong>" . $row['nomeEvento'] . "</strong><br>";
                echo "Descrição: " . $row['descricaoEvento'] . "<br>";
                echo "Modificador: " . $row['modificadorEvento'] . " | Impacto: " . $row['impactoEvento'] . "<br>";
                echo "</label><hr>";
            }
        ?>
        <button type="submit">Confirmar Seleção</button>
    </form>

</body>
</html>
