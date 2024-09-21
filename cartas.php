<?php

class Carta {
    private $numero;
    private $naipe;

    public function __construct($numero, $naipe) {
        $this->numero = $numero;
        $this->naipe = $naipe;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getNaipe() {
        return $this->naipe;
    }

    public function mostrarCarta() {
        return $this->numero . " " . $this->naipe;
    }
}

function criarBaralho() {
    $Numeros = ['Ás', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];
    $Naipes = ['de Copas', 'de Paus', 'de Ouros', 'de Espadas'];

    $baralho = [];
    $SorteiaNmr = array_rand($Numeros, 7);

    for ($i = 0; $i < 7; $i++) {
       
        $NaipeAleatorio = $Naipes[array_rand($Naipes)];
        $NmrSorteado = $Numeros[$SorteiaNmr[$i]];

       
        $carta = new Carta($NmrSorteado, $NaipeAleatorio);
        $baralho[] = $carta;
    }

    return $baralho;
}

function jogarAdivinhacao() {
    $baralho = criarBaralho();
    $CartaCerta = $baralho[array_rand($baralho)];
    $tentativa = 0;
    $pontuacao = 3;

    do {
        echo "\nCartas disponíveis:\n";
        foreach ($baralho as $posicao => $carta) {
            echo ($posicao + 1) . ": " . $carta->mostrarCarta() . "\n";
        }

        $escolha = readline("\nEscolha uma carta pelo número (ou digite 0 para desistir): ");

        if ($escolha == 0) {
            echo "Você desistiu! A carta era: " . $CartaCerta->mostrarCarta() . "\n";
            return;
        }

        $tentativa++;

        if ($baralho[$escolha - 1]->mostrarCarta() == $CartaCerta->mostrarCarta()) {
            echo "Parabéns! Você acertou a carta " . $CartaCerta->mostrarCarta() . " em $tentativa tentativa(s)!\n";

            if ($tentativa == 1) {
                echo "Pontuação: 3\n";
            } elseif ($tentativa == 2) {
                echo "Pontuação: 2\n";
            } else {
                echo "Pontuação: 1\n";
            }
            return;
        } else {
            echo "Carta errada. Tente novamente.\n";
        }
    } while (true);
}
jogarAdivinhacao();
