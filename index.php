<?php

function binary_search($lista, $item){

    $baixo = 0;
    $alto = count($lista) - 1;
    $contador = 0;
    
    while($baixo <= $alto) {
        $meio = ($baixo + $alto) / 2;
        $chute = $lista[$meio];

        if($item == $chute){
            echo "O $item foi encontrado!\n";
            echo "Foram necessarias $contador vezes para acha-lo!\n";
            return;
        }
        if($chute > $item){
            $alto = $meio - 1;
            $contador++;
        } else {
            $baixo = $meio + 1;
            $contador++;
        }
    }
    echo "Nada foi encontrado!";
    return;

}

$my_list = range(1, 129);
binary_search($my_list, 126);