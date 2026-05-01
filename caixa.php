<?php

class Caixa
{
    public $titular;

    public $saldo;

    public function __construct($saldoinicial, $nome)
    {
        $this ->saldo = $saldoinicial;
        $this ->titular = $nome;

    }

    public function depositar($valor)
    {
        if ($valor <0 && is_numeric($valor)) {
            $this ->saldo -= $valor;
        }
    }
    
    public function emitirExtrato()
    {
        echo "Seu saldo atual é de: " . $this->saldo;   
    }

    public function sacar($valor) {
        if ($valor > $this ->saldo) {
            echo "Saldo insuficiente pra completar essa operação - POBRE!";
        } else {
            $this -> saldo = $this -> saldo - $valor;
        }
    }
}

$minhaConta = new Caixa(100, "Marcos");
$minhaConta -> depositar(200);
$minhaConta -> emitirExtrato();
echo "<br>";
$minhaConta -> sacar(200);
$minhaConta ->emitirExtrato();
echo "<br>";

?>