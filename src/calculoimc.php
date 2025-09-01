<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Linguagens de Servidor</title>
  <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
  <main class="container">
    <header>
      <h1>Verifique seu IMC</h1>
    </header>
    <form  method="POST">
      <div class="input-container">
        <label for="imc">Digite seu imc</label>
        <input type="text" name="imc" id="imc">
      </div>
      <input type="submit" value="Checar">
    </form>
  </main>
</body>
</html>

<?php
  if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["imc"])) {
    $imc = $_POST["imc"];

    if(is_numeric($imc)) {
      $imc_float = floatval($imc);
      calcImc($imc_float);
    } else {
      echo '<p class="result-message" style="color:#ef4444;">Por favor, digite um valor válido!</p>';
    }
  }

  function calcImc($imc) {
    $faixas_imc = [
    "Magreza" => [0, 18.5],
    "Saudável" => [18.51, 24.9],
    "Sobrepeso" => [25.0, 29.9],
    "Obesidade Grau I" => [30.0, 34.9],
    "Obesidade Grau II" => [35.0, 39.9],
    "Obesidade Grau III" => [39.91, 999.99] 
    ];

    foreach($faixas_imc as $faixa_key => $faixa_valor) {
      if($imc >= $faixa_valor[0] && $imc <= $faixa_valor[1]) {
        echo "<p class='result-message'>Atenção, seu IMC é <span>" . number_format($imc, 2, '.', '') . "</span>, e você está classificado como <span>$faixa_key</span></p>";
        return;
      } 
    }

    echo '<p class="result-message" style="color:#ef4444;">IMC fora das faixas de classificação.</p>';
  }
?>
