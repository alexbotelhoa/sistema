<style type="text/css">
    body{
        margin: 0px 0px 0px 0px;
        padding: 0;
    }
</style>
<?php
include "libchart/libchart/classes/libchart.php";

$url = "https://demo4417994.mockable.io/clientes/";
$baseclientes = json_decode(file_get_contents($url));

include 'conexao.php';
include 'funcoes.php';
//echo "<pre>";
    $sql = "
        SELECT pag_cliente_id, GROUP_CONCAT(CONCAT_WS(',', pag_data, pag_reco, round((pag_pago/pag_reco))) ORDER BY pag_data ASC SEPARATOR '/') as informacoes, count(1) as contador
        FROM sm_pagamentos
        WHERE pag_data BETWEEN ADDDATE('".$_GET['ano']."-".$_GET['mes']."-01', INTERVAL -6 MONTH) AND '".$_GET['ano']."-".$_GET['mes']."-31'
        GROUP BY pag_cliente_id
        ORDER BY pag_cliente_id ASC
    ";
    $consulta = mysqli_query($con, $sql) or die ("<font style=Arial color=red>Houve um erro na consulta 1 dos dados</font>");
    $Tmrr0=0; $Tnew0=0; $Texpan0=0; $Tresur0=0; $Tcontr0=0; $Tcance0=0; $Tmrr1=0; $Tnew1=0; $Texpan1=0; $Tresur1=0; $Tcontr1=0; $Tcance1=0; $x=0;
    $cli_mrr=array(); $cli_new=array(); $cli_expan=array(); $cli_resur=array(); $cli_contr=array(); $cli_cance=array();
    while ($dados = mysqli_fetch_array($consulta)) {
        $mes[6]=0;$mes[5]=0;$mes[4]=0;$mes[3]=0;$mes[2]=0;$mes[1]=0;$mes[0]=0;
        $infoPag = explode('/', $dados['informacoes']);

        for ($d=0;$d<count($infoPag);$d++) {
            $infoDados = explode(',', $infoPag[$d]);
            $dia = explode('-',$infoDados[0]);
            $diff = dataDiff($infoDados[0],$_GET['ano'].'-'.$_GET['mes'].'-'.$dia[2]);

            switch ($infoDados[1]) {
                case 1: $mes[$diff]=$infoDados[2]; break;
                case 2: $mes[$diff]=$mes[($diff-1)]=$infoDados[2]; break;
                case 3: $mes[$diff]=$mes[($diff-1)]=$mes[($diff-2)]=$infoDados[2]; break;
                case 4: $mes[$diff]=$mes[($diff-1)]=$mes[($diff-2)]=$mes[($diff-3)]=$infoDados[2]; break;
                case 5: $mes[$diff]=$mes[($diff-1)]=$mes[($diff-2)]=$mes[($diff-3)]=$mes[($diff-4)]=$infoDados[2]; break;
                case 6: $mes[$diff]=$mes[($diff-1)]=$mes[($diff-2)]=$mes[($diff-3)]=$mes[($diff-4)]=$mes[($diff-5)]=$infoDados[2]; break;
            }
        }

        if ($mes[0]!=0) {$cli_mrr[] = $dados[0]; $Tmrr0 = $Tmrr0 + $mes[0];}
        if ($mes[0]!=0 and $dados['contador']==1) {$cli_new[] = $dados[0]; $Tnew0 = $Tnew0 + $mes[0];}
        if ($mes[0]!=0 and $mes[1]!=0 and $mes[0]>$mes[1]) {$cli_expan[] = $dados[0]; $Texpan0 = $Texpan0 + ($mes[0]-$mes[1]);}
        if ($mes[0]!=0 and $mes[1]==0 and $dados['contador']>1) {$cli_resur[] = $dados[0]; $Tresur0 = $Tresur0 + $mes[0];}
        if ($mes[0]!=0 and $mes[1]!=0 and $mes[0]<$mes[1]) {$cli_contr[] = $dados[0]; $Tcontr0 = $Tcontr0 + ($mes[1]-$mes[0]);}
        if ($mes[0]==0 and $mes[1]!=0) {$cli_cance[] = $dados[0]; $Tcance0 = $Tcance0 + $mes[1];}
        $x++;
    } mysqli_free_result($consulta); mysqli_close($con);

    $cli_selec = array(); $cli_sele = array(); $cli_sele = array(); $cli_sele = array(); $cli_sele = array(); $cli_sele = array();

    if (isset($_GET['mrr'])) {
        for ($x = 0; $x < count($cli_mrr); $x++) {
            $cli_selec[$cli_mrr[$x]] = 0;
        }
    }

    if (isset($_GET['new'])) {
        for ($x = 0; $x < count($cli_new); $x++) {
            $cli_selec[$cli_new[$x]] = 0;
        }
    }

    if (isset($_GET['expan'])) {
        for ($x = 0; $x < count($cli_expan); $x++) {
            $cli_selec[$cli_expan[$x]] = 0;
        }
    }

    if (isset($_GET['resur'])) {
        for ($x = 0; $x < count($cli_resur); $x++) {
            $cli_selec[$cli_resur[$x]] = 0;
        }
    }

    if (isset($_GET['contr'])) {
        for ($x = 0; $x < count($cli_contr); $x++) {
            $cli_selec[$cli_contr[$x]] = 0;
        }
    }

    if (isset($_GET['cance'])) {
        for ($x = 0; $x < count($cli_resur); $x++) {
            $cli_selec[$cli_resur[$x]] = 0;
        }
    }

    $cli_filtro = array_replace($cli_selec, array_intersect_key($baseclientes, $cli_selec));
    $segmento = array(array_values($cli_filtro));
    for($s=0;$s<(count($segmento,1)-1);$s++) {
        $seg1[] = $segmento[0][$s]->segmento;
    }

    $seg2 = array_count_values($seg1);
    $seg3 = array_values(array_count_values($seg1));

    $d=0;
    while (current($seg2)) {
        $seg4[] = [key($seg2),$seg3[$d]];
        next($seg2); $d++;
    }

    $sort = array();
    foreach ($seg4 as $key => $row) {
        $sort[0][$key]  = $row[0];
        $sort[1][$key] = $row[1];
    }

    array_multisort($sort[1], SORT_ASC, $seg4);

if (isset($_GET['mrr'])) {
    $chart = new HorizontalBarChart(600, 600);
    $dataSet = new XYDataSet();

    for ($g = 0; $g < count($seg4); $g++) {
        $dataSet->addPoint(new Point($seg4[$g][0], $seg4[$g][1]));
    }

    $chart->setDataSet($dataSet);
    $chart->getPlot()->setGraphPadding(new Padding(5, 50, 20, 140));
    $chart->setTitle("Rank das Areas em Expansão");
    $chart->render("imagens/grafico/metricas_mrr.png");

    echo "<img alt='Horizontal bars chart' src='imagens/grafico/metricas_mrr.png' style='border: 0px solid gray;'>";
}

if (isset($_GET['new'])) {
    $chart = new HorizontalBarChart(600, 600);
    $dataSet = new XYDataSet();

    for ($g = 0; $g < count($seg4); $g++) {
        $dataSet->addPoint(new Point($seg4[$g][0], $seg4[$g][1]));
    }

    $chart->setDataSet($dataSet);
    $chart->getPlot()->setGraphPadding(new Padding(5, 50, 20, 140));
    $chart->setTitle("Rank das Areas em Expansão");
    $chart->render("imagens/grafico/metricas_new.png");

    echo "<img alt='Horizontal bars chart' src='imagens/grafico/metricas_new.png' style='border: 0px solid gray;'>";
}

if (isset($_GET['expan'])) {
    $chart = new HorizontalBarChart(600, 600);
    $dataSet = new XYDataSet();

    for ($g = 0; $g < count($seg4); $g++) {
        $dataSet->addPoint(new Point($seg4[$g][0], $seg4[$g][1]));
    }

    $chart->setDataSet($dataSet);
    $chart->getPlot()->setGraphPadding(new Padding(5, 50, 20, 140));
    $chart->setTitle("Rank das Areas em Expansão");
    $chart->render("imagens/grafico/metricas_expan.png");

    echo "<img alt='Horizontal bars chart' src='imagens/grafico/metricas_expan.png' style='border: 0px solid gray;'>";
}

if (isset($_GET['resur'])) {
    $chart = new HorizontalBarChart(600, 600);
    $dataSet = new XYDataSet();

    for ($g = 0; $g < count($seg4); $g++) {
        $dataSet->addPoint(new Point($seg4[$g][0], $seg4[$g][1]));
    }

    $chart->setDataSet($dataSet);
    $chart->getPlot()->setGraphPadding(new Padding(5, 50, 20, 140));
    $chart->setTitle("Rank das Areas em Expansão");
    $chart->render("imagens/grafico/metricas_resur.png");

    echo "<img alt='Horizontal bars chart' src='imagens/grafico/metricas_resur.png' style='border: 0px solid gray;'>";
}

if (isset($_GET['contr'])) {
    $chart = new HorizontalBarChart(600, 600);
    $dataSet = new XYDataSet();

    for ($g = 0; $g < count($seg4); $g++) {
        $dataSet->addPoint(new Point($seg4[$g][0], $seg4[$g][1]));
    }

    $chart->setDataSet($dataSet);
    $chart->getPlot()->setGraphPadding(new Padding(5, 50, 20, 140));
    $chart->setTitle("Rank das Areas em Expansão");
    $chart->render("imagens/grafico/metricas_contr.png");

    echo "<img alt='Horizontal bars chart' src='imagens/grafico/metricas_contr.png' style='border: 0px solid gray;'>";
}

if (isset($_GET['cance'])) {
    $chart = new HorizontalBarChart(600, 600);
    $dataSet = new XYDataSet();

    for ($g = 0; $g < count($seg4); $g++) {
        $dataSet->addPoint(new Point($seg4[$g][0], $seg4[$g][1]));
    }

    $chart->setDataSet($dataSet);
    $chart->getPlot()->setGraphPadding(new Padding(5, 50, 20, 140));
    $chart->setTitle("Rank das Areas em Expansão");
    $chart->render("imagens/grafico/metricas_cance.png");

    echo "<img alt='Horizontal bars chart' src='imagens/grafico/metricas_cance.png' style='border: 0px solid gray;'>";
}

?>



