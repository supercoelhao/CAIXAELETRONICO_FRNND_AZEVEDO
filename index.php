<?php
session_start();

if (!isset($_SESSION['saldo'])) {
    $_SESSION['saldo'] = 0;
    $_SESSION['extrato'] = []; 
}

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     
    $valor = isset($_POST['valor']) ? floatval($_POST['valor']) : 0;
    
    if (isset($_POST['btn_depositar'])) {
        if ($valor > 0) {
            $_SESSION['saldo'] += $valor; 
            $_SESSION['extrato'][] = "Depósito: + R$ " . number_format($valor, 2, ',', '.');
            $mensagem = "<span style='color: green;'>Depósito realizado com sucesso!</span>";
        } else {
            $mensagem = "<span style='color: red;'>Digite um valor válido para depositar.</span>";
        }
    } 
    
    elseif (isset($_POST['btn_sacar'])) {
        if ($valor > 0) {
            if ($valor <= $_SESSION['saldo']) {
                $_SESSION['saldo'] -= $valor; 
                $_SESSION['extrato'][] = "Saque: - R$ " . number_format($valor, 2, ',', '.');
                $mensagem = "<span style='color: blue;'>Saque realizado com sucesso!</span>";
            } else {
                $mensagem = "<span style='color: red;'>Erro: Saldo insuficiente para este saque!</span>";
            }
        } else {
            $mensagem = "<span style='color: red;'>Digite um valor válido para saque.</span>";
        }
    }
    
    elseif (isset($_POST['btn_reiniciar'])) {
        session_destroy();
        header("Location: index.php");
        exit;
    }
}
?>

<h1>Caixa Eletrônico PHP</h1>

<h3>Saldo Atual: R$ <?php echo number_format($_SESSION['saldo'], 2, ',', '.'); ?></h3>

<p><b><?php echo $mensagem; ?></b></p>

<form method="post">
    Valor (R$): <input type="number" step="0.01" name="valor" placeholder="0.00">
    <br><br>
    <button type="submit" name="btn_depositar">Fazer Depósito</button>
    <button type="submit" name="btn_sacar">Fazer Saque</button>
</form>

<hr>

<h2>Extrato da Conta</h2>
<ul>
    <?php
    if (count($_SESSION['extrato']) == 0) {
        echo "<li>Nenhuma movimentação ainda.</li>";
    } else {
        foreach ($_SESSION['extrato'] as $movimentacao) {
            echo "<li>" . $movimentacao . "</li>";
        }
    }
    ?>
</ul>

<hr>
<form method="post">
    <button type="submit" name="btn_reiniciar">Zerar e Reiniciar Máquina</button>
</form>