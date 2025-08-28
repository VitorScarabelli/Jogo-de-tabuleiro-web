<?php
    $eventosSelecionados = $_POST['eventos_selecionados'];
    for($i=0; $i < count($eventosSelecionados); $i++){
        $casas = rand(1, 50);
        ECHO $eventosSelecionados[$i] . " - Casa: " . $casas . "<br>";
    }


    echo "<h2>Eventos selecionados:</h2><ul>";
    foreach ($eventosSelecionados as $idEvento) {
        echo "ID do Evento: $idEvento </br>";
    }
?>