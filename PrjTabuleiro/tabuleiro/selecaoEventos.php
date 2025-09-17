<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Escolher Eventos</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php 
        include("../banco/conexao.php"); 
        $stmt = $pdo->query("SELECT * FROM tbevento");
    ?>

  <h1>Escolha os eventos e as casas:</h1>

  <form method="POST" action="tb.php"> 
    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
      <div style="margin-bottom:15px;">
        <label>
          <input type="checkbox" name="eventos[<?= $row['idEvento'] ?>][ativo]" value="1">
          <strong><?= $row['nomeEvento'] ?></strong>
        </label><br>
        Descrição: <?= $row['descricaoEvento'] ?><br>
        Modificador: <?= $row['modificadorEvento'] ?><br>
        <label>
          Casa: <input type="number" name="eventos[<?= $row['idEvento'] ?>][casa]" min="1" max="34">
        </label>
        <input type="hidden" name="eventos[<?= $row['idEvento'] ?>][nome]" value="<?= htmlspecialchars($row['nomeEvento']) ?>">
        <input type="hidden" name="eventos[<?= $row['idEvento'] ?>][descricao]" value="<?= htmlspecialchars($row['descricaoEvento']) ?>">
        <input type="hidden" name="eventos[<?= $row['idEvento'] ?>][modificador]" value="<?= htmlspecialchars($row['modificadorEvento']) ?>">
      </div>
      <hr>
    <?php endwhile; ?>
    <button type="submit">Confirmar Seleção</button>
  </form>
</body>
</html>
