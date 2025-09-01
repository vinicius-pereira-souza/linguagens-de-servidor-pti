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
      echo 'Por favor, digite um valor válido!';
    }
  }

  function calcImc($imc) {
    $faixas_imc = [
      "Magreza" => [0, 18.5], 
      "Saudável" => [18.51, 24.9], 
      "Sobrepeso" => [25.0, 29.9], 
      "Obesidade Grau I" => [30.0, 34.9], 
      "Obesidade Grau II" => [35.0, 39.9], 
      "Obesidade Grau III" => [39.9]
    ];

    foreach($faixas_imc as $faixa_key => $faixa_valor) {
      if($imc >= $faixa_valor[0] && $imc <= $faixa_valor[1]) {
        $faixa = $faixa_key;

        echo "<p>Atenção, seu IMC é <span>$imc</span>, e você está classificado como <span>$faixa</span></p>";
        return;
      } else if($imc > $faixa_valor[1]) {
        $ultima_faixa = array_key_last($faixas_imc);
        echo "<p>Atenção, seu IMC é <span>$imc</span>, e você está classificado como <span>$ultima_faixa</span></p>";
        return;
      }
      
    }
  }  
?>
