<?php

class Pessoa
{  
    public $nome;
    private $cpf;
    protected $idade;
    public function __construct($nome, $cpf, $idade) {
        $this -> nome = $nome;
        $this -> cpf = $cpf;
        $this -> idade = $idade;
    }
    public function GetCPF(){
     return $this->cpf;
    }

}

class Mulher extends Pessoa {
    
}

$umaPessoa = new Pessoa("Luffy", "123.456.789-10", 19);
echo $umaPessoa->nome
echo "<br>";
echo $umaPessoa->GetCPF


?>
