<?php

if (isset($_POST["query"])) {
// Sua chave de API da OpenAI
$api_key = "AQUI SUA CHAVE";

// Os dados da consulta que você deseja enviar ao modelo
  $query = $_POST["query"];

// A URL da API
$url = "https://api.openai.com/v1/completions";

// Configuração da solicitação cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{
  "model": "text-davinci-003",
  "prompt": "' . $query . '",
  "temperature": 0.9,
  "max_tokens": 1050,
  "top_p": 1,
  "frequency_penalty": 0,
  "presence_penalty": 0.6,
  "stop": [" Você:", " AI:"]
}');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $api_key
));

// Executa a solicitação cURL
$output = curl_exec($ch);


// Verifica se houve erro na solicitação
if (curl_errno($ch)) {
    echo 'Erro: ' . curl_error($ch);
}
 
// Fecha a sessão cURL
curl_close($ch);

// Decodifica a resposta JSON
$result = json_decode($output, true);

//print_r($result);

$totalresp = count($result["choices"]);
$x = 0;
while($x <= $totalresp) {
echo $result["choices"][$x]["text"];
  $x++;
}


}
?>



