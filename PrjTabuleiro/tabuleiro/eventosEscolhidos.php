<?php
    include('../banco/conexao.php');
	
    $eventosSelecionados = $_REQUEST['eventos_selecionados'] ?? [];
    $casaEventos = [];
    
    for($i=0; $i < count($eventosSelecionados); $i++){
        $casaEventos[$i] = random_int(1, 50);
    }

    function obterNomeEvento($pdo, $idEvento) {
        $stmt = $pdo->prepare("SELECT nomeEvento FROM tbevento WHERE idEvento = ?");
        $stmt->execute([$idEvento]);
        $row = $stmt->fetch(PDO::FETCH_BOTH);
        return $row['nomeEvento'];
    }

    $arrayMap = array_map(function($idEvento, $casa) use ($pdo) {
        $nomeEvento = obterNomeEvento($pdo, $idEvento);
        return "Evento: " . $nomeEvento . " - Casa: " . $casa . "<br/>";
    }, $eventosSelecionados, $casaEventos);

    echo implode($arrayMap);
    
?>