<?php 


function clear(){
    if (PHP_OS === "WINNT") {
        system("cls");
    } else {
        system("clear");
    }
}

$palabras_posibles = ["bedida","prisma","ala","dolor","piloto","baldosa","terremoto","asteroide","gallo","platzi"];
define("max_intentos", 6);

echo "juego del ahorcado \n\n";

// Inicializamos el juego //
$palabra_elegida = $palabras_posibles[rand(0, 9)];
$palabra_elegida = strtolower($palabra_elegida);
$longitud_de_descubrimiento = str_repeat("_", strlen($palabra_elegida));
$intentos = 0;

do {
    clear();
    echo "palabra de " . strlen($palabra_elegida) . " letras \n\n";
    echo "$longitud_de_descubrimiento \n\n";

    // Pedirle datos al usuario //
    $carta_del_jugador = readline("escribe una letra : ");
    $carta_del_jugador = strtolower($carta_del_jugador);

    if (str_contains($palabra_elegida, $carta_del_jugador)) {
        $compensar = 0;
        while (($posición_posterior = strpos($palabra_elegida, $carta_del_jugador, $compensar)) !== false) {
            $longitud_de_descubrimiento[$posición_posterior] = $carta_del_jugador;
            $compensar = $posición_posterior + 1;
        }
    } else {
        $intentos++;
        echo "letra incorrecta, te quedan " . (max_intentos - $intentos) . " intentos\n";
        sleep(2);
    }
} while ($intentos < max_intentos && $longitud_de_descubrimiento != $palabra_elegida);

if ($longitud_de_descubrimiento === $palabra_elegida) {
    echo "¡Felicidades, has adivinado la palabra: $palabra_elegida!\n";
} else {
    echo "¡Agotaste tus intentos! La palabra era: $palabra_elegida\n";
}

echo "la palabra es : $palabra_elegida\n";
echo "tu descubriste $longitud_de_descubrimiento";

?>
