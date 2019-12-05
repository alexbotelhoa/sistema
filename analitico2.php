<style type="text/css">
    body{
        margin: 0px 0px 0px 0px;
        padding: 0;
    }
</style>
<pre>
<?php
include "libchart/libchart/classes/libchart.php";
include 'conexao.php';
include 'funcoes.php';

    $sql = "
        SELECT pag_cliente_id, GROUP_CONCAT(CONCAT_WS(',', pag_data, pag_reco, round((pag_pago/pag_reco))) ORDER BY pag_data ASC SEPARATOR '/') as informacoes, count(1) as contador
        FROM sm_pagamentos
        WHERE pag_data BETWEEN ADDDATE('".$_GET['ano']."-".$_GET['mes']."-01', INTERVAL -18 MONTH) AND '".$_GET['ano']."-".$_GET['mes']."-31'
        GROUP BY pag_cliente_id
        ORDER BY pag_cliente_id ASC
    ";
    $consulta = mysqli_query($con, $sql) or die ("<font style=Arial color=red>Houve um erro na consulta 1 dos dados</font>");
    $x = 0;
    $date = strtotime($_GET['ano'] . "-" . $_GET['mes'] . "-01");

    $Tarpu0=0;
    $Tchurn0=0;
    $Tltv0=0;
    $Tmrr0 = 0;
    $Tcance0 = 0;

    $Tarpu1 = 0;
    $Tchurn1 = 0;
    $Tltv1 = 0;
    $Tmrr1 = 0;
    $Tcance1 = 0;

    $Tarpu2 = 0;
    $Tchurn2 = 0;
    $Tltv2 = 0;
    $Tmrr2 = 0;
    $Tcance2 = 0;

    $Tarpu3 = 0;
    $Tchurn3 = 0;
    $Tltv3 = 0;
    $Tmrr3 = 0;
    $Tcance3 = 0;

    $Tarpu4 = 0;
    $Tchurn4 = 0;
    $Tltv4 = 0;
    $Tmrr4 = 0;
    $Tcance4 = 0;

    $Tarpu5 = 0;
    $Tchurn5 = 0;
    $Tltv5 = 0;
    $Tmrr5 = 0;
    $Tcance5 = 0;

    $Tarpu6 = 0;
    $Tchurn6 = 0;
    $Tltv6 = 0;
    $Tmrr6 = 0;
    $Tcance6 = 0;

    $Tarpu7 = 0;
    $Tchurn7 = 0;
    $Tltv7 = 0;
    $Tmrr7 = 0;
    $Tcance7 = 0;

    $Tarpu8 = 0;
    $Tchurn8 = 0;
    $Tltv8 = 0;
    $Tmrr8 = 0;
    $Tcance8 = 0;

    $Tarpu9 = 0;
    $Tchurn9 = 0;
    $Tltv9 = 0;
    $Tmrr9 = 0;
    $Tcance9 = 0;

    $Tarpu10 = 0;
    $Tchurn10 = 0;
    $Tltv10 = 0;
    $Tmrr10 = 0;
    $Tcance10 = 0;

    $Tarpu11 = 0;
    $Tchurn11 = 0;
    $Tltv11 = 0;
    $Tmrr11 = 0;
    $Tcance11 = 0;

    $qp0 = 0;
    $qc0 = 0;
    $qp1 = 0;
    $qc1 = 0;
    $qp2 = 0;
    $qc2 = 0;
    $qp3 = 0;
    $qc3 = 0;
    $qp4 = 0;
    $qc4 = 0;
    $qp5 = 0;
    $qc5 = 0;
    $qp6 = 0;
    $qc6 = 0;
    $qp7 = 0;
    $qc7 = 0;
    $qp8 = 0;
    $qc8 = 0;
    $qp9 = 0;
    $qc9 = 0;
    $qp10 = 0;
    $qc10 = 0;
    $qp11 = 0;
    $qc11 = 0;

    while ($dados = mysqli_fetch_array($consulta)) {
        $mes[0] = 0;
        $mes[1] = 0;
        $mes[2] = 0;
        $mes[3] = 0;
        $mes[4] = 0;
        $mes[5] = 0;
        $mes[6] = 0;
        $mes[7] = 0;
        $mes[8] = 0;
        $mes[9] = 0;
        $mes[10] = 0;
        $mes[11] = 0;

        $infoPag = explode('/', $dados['informacoes']);

        for ($d = 0; $d < count($infoPag); $d++) {
            $infoDados = explode(',', $infoPag[$d]);
            $dia = explode('-', $infoDados[0]);
            $diff = dataDiff($infoDados[0], $_GET['ano'] . '-' . $_GET['mes'] . '-' . $dia[2]);

            switch ($infoDados[1]) {
                case 1:
                    $mes[$diff] = $infoDados[2];
                    break;
                case 2:
                    $mes[$diff] = $mes[($diff - 1)] = $infoDados[2];
                    break;
                case 3:
                    $mes[$diff] = $mes[($diff - 1)] = $mes[($diff - 2)] = $infoDados[2];
                    break;
                case 4:
                    $mes[$diff] = $mes[($diff - 1)] = $mes[($diff - 2)] = $mes[($diff - 3)] = $infoDados[2];
                    break;
                case 5:
                    $mes[$diff] = $mes[($diff - 1)] = $mes[($diff - 2)] = $mes[($diff - 3)] = $mes[($diff - 4)] = $infoDados[2];
                    break;
                case 6:
                    $mes[$diff] = $mes[($diff - 1)] = $mes[($diff - 2)] = $mes[($diff - 3)] = $mes[($diff - 4)] = $mes[($diff - 5)] = $infoDados[2];
                    break;
            }
        }

        $rs = 0;
        if ($mes[0] != 0) {
            $Tmrr0 = $Tmrr0 + $mes[0]; $qp0++;
        }
        if ($mes[0] == 0 and $mes[1] != 0) {
            $Tcance0 = $Tcance0 + $mes[1]; $qc0++;
        }


        if ($mes[1] != 0) {
            $Tmrr1 = $Tmrr1 + $mes[1]; $qp1++;
        }
        if ($mes[1] == 0 and $mes[2] != 0) {
            $Tcance1 = $Tcance1 + $mes[2]; $qc1++;
        }


        if ($mes[2] != 0) {
            $Tmrr2 = $Tmrr2 + $mes[2]; $qp2++;
        }
        if ($mes[2] == 0 and $mes[3] != 0) {
            $Tcance2 = $Tcance2 + $mes[3]; $qc2++;
        }


        if ($mes[3] != 0) {
            $Tmrr3 = $Tmrr3 + $mes[3]; $qp3++;
        }
        if ($mes[3] == 0 and $mes[4] != 0) {
            $Tcance3 = $Tcance3 + $mes[4]; $qc3++;
        }


        if ($mes[4] != 0) {
            $Tmrr4 = $Tmrr4 + $mes[4]; $qp4++;
        }
        if ($mes[4] == 0 and $mes[5] != 0) {
            $Tcance4 = $Tcance4 + $mes[5]; $qc4++;
        }


        if ($mes[5] != 0) {
            $Tmrr5 = $Tmrr5 + $mes[5]; $qp5++;
        }
        if ($mes[5] == 0 and $mes[6] != 0) {
            $Tcance5 = $Tcance5 + $mes[6]; $qc5++;
        }


        if ($mes[6] != 0) {
            $Tmrr6 = $Tmrr6 + $mes[6]; $qp6++;
        }
        if ($mes[6] == 0 and $mes[7] != 0) {
            $Tcance6 = $Tcance6 + $mes[7]; $qc6++;
        }


        if ($mes[7] != 0) {
            $Tmrr7 = $Tmrr7 + $mes[7]; $qp7++;
        }
        if ($mes[7] == 0 and $mes[8] != 0) {
            $Tcance7 = $Tcance7 + $mes[8]; $qc7++;
        }


        if ($mes[8] != 0) {
            $Tmrr8 = $Tmrr8 + $mes[8]; $qp8++;
        }
        if ($mes[8] == 0 and $mes[9] != 0) {
            $Tcance8 = $Tcance8 + $mes[9]; $qc8++;
        }


        if ($mes[9] != 0) {
            $Tmrr9 = $Tmrr9 + $mes[9]; $qp9++;
        }
        if ($mes[9] == 0 and $mes[10] != 0) {
            $Tcance9 = $Tcance9 + $mes[10]; $qc9++;
        }


        if ($mes[10] != 0) {
            $Tmrr10 = $Tmrr10 + $mes[10]; $qp10++;
        }
        if ($mes[10] == 0 and $mes[11] != 0) {
            $Tcance10 = $Tcance10 + $mes[11]; $qc10++;
        }


        if ($mes[11] != 0) {
            $Tmrr11 = $Tmrr11 + $mes[11]; $qp11++;
        }
        if ($mes[11] == 0 and $mes[12] != 0) {
            $Tcance11 = $Tcance11 + $mes[12]; $qc11++;
        }

        $x++;
    }
    mysqli_free_result($consulta);
    mysqli_close($con);

    $Tmrr[] = [$Tmrr0,$Tmrr1,$Tmrr2,$Tmrr3,$Tmrr4,$Tmrr5,$Tmrr6,$Tmrr7,$Tmrr8,$Tmrr9,$Tmrr10,$Tmrr11];
    $qp[] = [$qp0,$qp1,$qp2,$qp3,$qp4,$qp5,$qp6,$qp7,$qp8,$qp9,$qp10,$qp11];
    $Tcance[] = [$Tcance0,$Tcance1,$Tcance2,$Tcance3,$Tcance4,$Tcance5,$Tcance6,$Tcance7,$Tcance8,$Tcance9,$Tcance10,$Tcance11];
    $qc[] = [$qc0,$qc1,$qc2,$qc3,$qc4,$qc5,$qc6,$qc7,$qc8,$qc9,$qc10,$qc11];

    for ($a=0;$a<12;$a++) {
        $Tarpu[$a] = $Tmrr[0][$a] / $qp[0][$a];
    }

    for ($a=0;$a<12;$a++) {
        $Tchurn[$a] = ($qc[0][$a] * 100) / $qp[0][$a];
    }

    for ($a=0;$a<12;$a++) {
        $Tltv[$a] = 0;
    }


    if (isset($_GET['arpu'])) {
        $chart = new LineChart(600, 300);
        $dataSet = new XYDataSet();

        for ($x=0;$x<12;$x++) {
            $xx = 11 - $x;
                $dataSet->addPoint(new Point(date("M/Y", strtotime("-$xx month", $date)), $Tarpu[$x]));
        }

        $chart->setDataSet($dataSet);
        $chart->setTitle("Evolução Anual da ARPU (R$)");
        $chart->render("imagens/grafico/metricas_meses_arpu.png");

        echo "<img alt='Métricas SaaS' src='imagens/grafico/metricas_meses_arpu.png' style='border: 0px solid gray;'>";
    }

    if (isset($_GET['churn'])) {
        $chart = new LineChart(600, 300);
        $dataSet = new XYDataSet();

        for ($x=0;$x<12;$x++) {
            $xx = 11 - $x;
            $dataSet->addPoint(new Point(date("M/Y", strtotime("-$xx month", $date)), $Tchurn[$x]));
        }

        $chart->setDataSet($dataSet);
        $chart->setTitle("Evolução Anual de Churn (%)");
        $chart->render("imagens/grafico/metricas_meses_churn.png");

        echo "<img alt='Métricas SaaS' src='imagens/grafico/metricas_meses_churn.png' style='border: 0px solid gray;'>";
    }

    if (isset($_GET['ltv'])) {
        $chart = new LineChart(600, 300);
        $dataSet = new XYDataSet();

        for ($x=0;$x<12;$x++) {
            $xx = 11 - $x;
            $dataSet->addPoint(new Point(date("M/Y", strtotime("-$xx month", $date)), $Tltv[$x]));
        }

        $chart->setDataSet($dataSet);
        $chart->setTitle("Evolução Anual de LTV (R$)");
        $chart->render("imagens/grafico/metricas_meses_ltv.png");

        echo "<img alt='Métricas SaaS' src='imagens/grafico/metricas_meses_ltv.png' style='border: 0px solid gray;'>";
    }
?>