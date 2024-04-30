<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <header>
        <h1>Resultado:</h1>
    </header>
    <main>
    <p>
        <?php 
            $real = $_GET["real"];
            $inicio = date("m-d-Y", strtotime("-7 days"));
            $fim = date("m-d-Y");

            $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''.$inicio.'\'&@dataFinalCotacao=\''.$fim.'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,cotacaoVenda,dataHoraCotacao';

            $dados = json_decode(file_get_contents($url), true);
            $cotacao = $dados["value"][0]["cotacaoCompra"];
            $dolar = $real/$cotacao;
            
            $padrao = numfmt_create("pt_BR", NumberFormatter::CURRENCY);

            echo "Seus <strong>" . numfmt_format_currency($padrao, $real, "BRL") . "</strong> equivalente a <strong>" . numfmt_format_currency($padrao, $dolar, "USD") . "</strong>";
            ?>
    </p>

        <button onclick="javascript:history.go(-1)">&#x2B05;Voltar</button>
    </main>
    
</body>
</html>