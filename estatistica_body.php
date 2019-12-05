<center><br>
    <form action='estatistica.php' method='POST'>
        <font color="#00008b" size="2">Escolha um mês e um ano</font>
        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
            <tr height="40" bgcolor="#f0f8ff">
                <td width="40" align="right">Mês&nbsp;</td>
                <td width="90" align="center">
                    <select name="mes" autofocus>
                        <option value="00" >Selecione</option>
                        <option value="01" <?php if (isset($_POST['mes'])) {if ($_POST['mes']=='01') {echo "selected";}}?>>Janeiro</option>
                        <option value="02" <?php if (isset($_POST['mes'])) {if ($_POST['mes']=='02') {echo "selected";}}?>>Fevereiro</option>
                        <option value="03" <?php if (isset($_POST['mes'])) {if ($_POST['mes']=='03') {echo "selected";}}?>>Março</option>
                        <option value="04" <?php if (isset($_POST['mes'])) {if ($_POST['mes']=='04') {echo "selected";}}?>>Abril</option>
                        <option value="05" <?php if (isset($_POST['mes'])) {if ($_POST['mes']=='05') {echo "selected";}}?>>Maio</option>
                        <option value="06" <?php if (isset($_POST['mes'])) {if ($_POST['mes']=='06') {echo "selected";}}?>>Junho</option>
                        <option value="07" <?php if (isset($_POST['mes'])) {if ($_POST['mes']=='07') {echo "selected";}}?>>Julho</option>
                        <option value="08" <?php if (isset($_POST['mes'])) {if ($_POST['mes']=='08') {echo "selected";}}?>>Agosto</option>
                        <option value="09" <?php if (isset($_POST['mes'])) {if ($_POST['mes']=='09') {echo "selected";}}?>>Setembro</option>
                        <option value="10" <?php if (isset($_POST['mes'])) {if ($_POST['mes']=='10') {echo "selected";}}?>>Outubro</option>
                        <option value="11" <?php if (isset($_POST['mes'])) {if ($_POST['mes']=='11') {echo "selected";}}?>>Novembro</option>
                        <option value="12" <?php if (isset($_POST['mes'])) {if ($_POST['mes']=='12') {echo "selected";}}?>>Dezembro</option>
                    </select>
                </td>
                <td width="40" align="right">Ano&nbsp;</td>
                <td width="90" align="center">
                    <select name="ano">
                        <option value="0000" <?php if (isset($_POST['ano'])) {if ($_POST['ano']=='0000' or $_POST['ano']=='') {echo "selected";}}?>>Selecione</option>
                        <option value="2019" <?php if (isset($_POST['ano'])) {if ($_POST['ano']=='2019') {echo "selected";}}?>>2019</option>
                        <option value="2018" <?php if (isset($_POST['ano'])) {if ($_POST['ano']=='2018') {echo "selected";}}?>>2018</option>
                        <option value="2017" <?php if (isset($_POST['ano'])) {if ($_POST['ano']=='2017') {echo "selected";}}?>>2017</option>
                        <option value="2016" <?php if (isset($_POST['ano'])) {if ($_POST['ano']=='2016') {echo "selected";}}?>>2016</option>
                        <option value="2015" <?php if (isset($_POST['ano'])) {if ($_POST['ano']=='2015') {echo "selected";}}?>>2015</option>
                    </select>
                </td>
                <td width="130" align='center'><input type='hidden' name='search' value='0'><input class='button' type='Submit' value='Buscar'></td>
            </tr>
        </table>
    </form>
<?php
include './libchart/libchart/classes/libchart.php';

    if (isset($_POST['search'])) {
        if ($_POST['mes'] == "0" or $_POST['ano'] == "0") {
            echo "<br><br><font style='Arial' size='3' color='red'>Você NÃO selecionou um MÊS e/ou um ANO!<br><br><br>";
            echo "<meta http-equiv='refresh' content='2;URL=estatistica.php'>";
        } else {
            $sql = "
                SELECT pag_cliente_id, GROUP_CONCAT(CONCAT_WS(',', pag_data, pag_reco, round((pag_pago/pag_reco))) ORDER BY pag_data ASC SEPARATOR '/') as informacoes, count(1) as contador
                FROM sm_pagamentos
                WHERE pag_data BETWEEN ADDDATE('" . $_POST['ano'] . "-" . $_POST['mes'] . "-01', INTERVAL -18 MONTH) AND '" . $_POST['ano'] . "-" . $_POST['mes'] . "-31'
                GROUP BY pag_cliente_id
                ORDER BY pag_cliente_id ASC
                ";
            $consulta = mysqli_query($con, $sql) or die ("<font style=Arial color=red>Houve um erro na consulta 1 dos dados</font>");
            $x = 0;
            $date = strtotime($_POST['ano'] . "-" . $_POST['mes'] . "-01");
            $Tmrr0 = 0;
            $Tnew0 = 0;
            $Texpan0 = 0;
            $Tresur0 = 0;
            $Tcontr0 = 0;
            $Tcance0 = 0;
            $Tmrr1 = 0;
            $Tnew1 = 0;
            $Texpan1 = 0;
            $Tresur1 = 0;
            $Tcontr1 = 0;
            $Tcance1 = 0;
            $Tmrr2 = 0;
            $Tnew2 = 0;
            $Texpan2 = 0;
            $Tresur2 = 0;
            $Tcontr2 = 0;
            $Tcance2 = 0;
            $Tmrr3 = 0;
            $Tnew3 = 0;
            $Texpan3 = 0;
            $Tresur3 = 0;
            $Tcontr3 = 0;
            $Tcance3 = 0;
            $Tmrr4 = 0;
            $Tnew4 = 0;
            $Texpan4 = 0;
            $Tresur4 = 0;
            $Tcontr4 = 0;
            $Tcance4 = 0;
            $Tmrr5 = 0;
            $Tnew5 = 0;
            $Texpan5 = 0;
            $Tresur5 = 0;
            $Tcontr5 = 0;
            $Tcance5 = 0;
            $Tmrr6 = 0;
            $Tnew6 = 0;
            $Texpan6 = 0;
            $Tresur6 = 0;
            $Tcontr6 = 0;
            $Tcance6 = 0;

            while ($dados = mysqli_fetch_array($consulta)) {
                $mes[7] = 0;
                $mes[6] = 0;
                $mes[5] = 0;
                $mes[4] = 0;
                $mes[3] = 0;
                $mes[2] = 0;
                $mes[1] = 0;
                $mes[0] = 0;
                $infoPag = explode('/', $dados['informacoes']);

                for ($d = 0; $d < count($infoPag); $d++) {
                    $infoDados = explode(',', $infoPag[$d]);
                    $dia = explode('-', $infoDados[0]);
                    $diff = dataDiff($infoDados[0], $_POST['ano'] . '-' . $_POST['mes'] . '-' . $dia[2]);

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
                    $Tmrr0 = $Tmrr0 + $mes[0];
                }
                if ($mes[0] != 0 and $dados['contador'] == 1) {
                    $Tnew0 = $Tnew0 + $mes[0];
                }
                if ($mes[0] != 0 and $mes[1] != 0 and $mes[0] > $mes[1]) {
                    $Texpan0 = $Texpan0 + ($mes[0] - $mes[1]);
                }
                if ($mes[0] != 0 and $mes[1] == 0 and $dados['contador'] > 1) {
                    $Tresur0 = $Tresur0 + $mes[0];
                    $rs++;
                }
                if ($mes[0] != 0 and $mes[1] != 0 and $mes[0] < $mes[1]) {
                    $Tcontr0 = $Tcontr0 + ($mes[1] - $mes[0]);
                }
                if ($mes[0] == 0 and $mes[1] != 0) {
                    $Tcance0 = $Tcance0 + $mes[1];
                }

                if ($mes[1] != 0) {
                    $Tmrr1 = $Tmrr1 + $mes[1];
                }
                if ($mes[1] != 0 and $dados['contador'] == 1) {
                    $Tnew1 = $Tnew1 + $mes[1];
                }
                if ($mes[1] != 0 and $mes[2] != 0 and $mes[1] > $mes[2]) {
                    $Texpan1 = $Texpan1 + ($mes[1] - $mes[2]);
                }
                if ($mes[1] != 0 and $mes[2] == 0 and $dados['contador'] > ($rs + 1)) {
                    $Tresur1 = $Tresur1 + $mes[1];
                    $rs++;
                }
                if ($mes[1] != 0 and $mes[2] != 0 and $mes[1] < $mes[2]) {
                    $Tcontr1 = $Tcontr1 + ($mes[2] - $mes[1]);
                }
                if ($mes[1] == 0 and $mes[2] != 0) {
                    $Tcance1 = $Tcance1 + $mes[2];
                }

                if ($mes[2] != 0) {
                    $Tmrr2 = $Tmrr2 + $mes[2];
                }
                if ($mes[2] != 0 and $dados['contador'] == 1) {
                    $Tnew2 = $Tnew2 + $mes[2];
                }
                if ($mes[2] != 0 and $mes[3] != 0 and $mes[2] > $mes[3]) {
                    $Texpan2 = $Texpan2 + ($mes[2] - $mes[3]);
                }
                if ($mes[2] != 0 and $mes[3] == 0 and $dados['contador'] > ($rs + 1)) {
                    $Tresur2 = $Tresur2 + $mes[2];
                    $rs++;
                }
                if ($mes[2] != 0 and $mes[3] != 0 and $mes[2] < $mes[3]) {
                    $Tcontr2 = $Tcontr2 + ($mes[3] - $mes[2]);
                }
                if ($mes[2] == 0 and $mes[3] != 0) {
                    $Tcance2 = $Tcance2 + $mes[3];
                }

                if ($mes[3] != 0) {
                    $Tmrr3 = $Tmrr3 + $mes[3];
                }
                if ($mes[3] != 0 and $dados['contador'] == 1) {
                    $Tnew3 = $Tnew3 + $mes[3];
                }
                if ($mes[3] != 0 and $mes[4] != 0 and $mes[3] > $mes[4]) {
                    $Texpan3 = $Texpan3 + ($mes[3] - $mes[4]);
                }
                if ($mes[3] != 0 and $mes[4] == 0 and $dados['contador'] > ($rs + 1)) {
                    $Tresur3 = $Tresur3 + $mes[3];
                    $rs++;
                }
                if ($mes[3] != 0 and $mes[4] != 0 and $mes[3] < $mes[4]) {
                    $Tcontr3 = $Tcontr3 + ($mes[4] - $mes[3]);
                }
                if ($mes[3] == 0 and $mes[4] != 0) {
                    $Tcance3 = $Tcance3 + $mes[4];
                }

                if ($mes[4] != 0) {
                    $Tmrr4 = $Tmrr4 + $mes[4];
                }
                if ($mes[4] != 0 and $dados['contador'] == 1) {
                    $Tnew4 = $Tnew4 + $mes[4];
                }
                if ($mes[4] != 0 and $mes[5] != 0 and $mes[4] > $mes[5]) {
                    $Texpan4 = $Texpan4 + ($mes[4] - $mes[5]);
                }
                if ($mes[4] != 0 and $mes[5] == 0 and $dados['contador'] > ($rs + 1)) {
                    $Tresur4 = $Tresur4 + $mes[4];
                    $rs++;
                }
                if ($mes[4] != 0 and $mes[5] != 0 and $mes[4] < $mes[5]) {
                    $Tcontr4 = $Tcontr4 + ($mes[5] - $mes[4]);
                }
                if ($mes[4] == 0 and $mes[5] != 0) {
                    $Tcance4 = $Tcance4 + $mes[5];
                }

                if ($mes[5] != 0) {
                    $Tmrr5 = $Tmrr5 + $mes[5];
                }
                if ($mes[5] != 0 and $dados['contador'] == 1) {
                    $Tnew5 = $Tnew5 + $mes[5];
                }
                if ($mes[5] != 0 and $mes[6] != 0 and $mes[5] > $mes[6]) {
                    $Texpan5 = $Texpan5 + ($mes[5] - $mes[6]);
                }
                if ($mes[5] != 0 and $mes[6] == 0 and $dados['contador'] > ($rs + 1)) {
                    $Tresur5 = $Tresur5 + $mes[5];
                    $rs++;
                }
                if ($mes[5] != 0 and $mes[6] != 0 and $mes[5] < $mes[6]) {
                    $Tcontr5 = $Tcontr5 + ($mes[6] - $mes[5]);
                }
                if ($mes[5] == 0 and $mes[6] != 0) {
                    $Tcance5 = $Tcance5 + $mes[6];
                }

                if ($mes[6] != 0) {
                    $Tmrr6 = $Tmrr6 + $mes[6];
                }
                if ($mes[6] != 0 and $dados['contador'] == 1) {
                    $Tnew6 = $Tnew6 + $mes[6];
                }
                if ($mes[6] != 0 and $mes[7] != 0 and $mes[6] > $mes[7]) {
                    $Texpan6 = $Texpan6 + ($mes[6] - $mes[7]);
                }
                if ($mes[6] != 0 and $mes[7] == 0 and $dados['contador'] > ($rs + 1)) {
                    $Tresur6 = $Tresur6 + $mes[6];
                    $rs++;
                }
                if ($mes[6] != 0 and $mes[7] != 0 and $mes[6] < $mes[7]) {
                    $Tcontr6 = $Tcontr6 + ($mes[7] - $mes[6]);
                }
                if ($mes[6] == 0 and $mes[7] != 0) {
                    $Tcance6 = $Tcance6 + $mes[7];
                }

                $cresc_real0 = ($Tnew0 + $Texpan0 + $Tresur0) - ($Tcontr0 + $Tcance0);
                $cresc_real1 = ($Tnew1 + $Texpan1 + $Tresur1) - ($Tcontr1 + $Tcance1);
                $cresc_real2 = ($Tnew2 + $Texpan2 + $Tresur2) - ($Tcontr2 + $Tcance2);
                $cresc_real3 = ($Tnew3 + $Texpan3 + $Tresur3) - ($Tcontr3 + $Tcance3);
                $cresc_real4 = ($Tnew4 + $Texpan4 + $Tresur4) - ($Tcontr4 + $Tcance4);
                $cresc_real5 = ($Tnew5 + $Texpan5 + $Tresur5) - ($Tcontr5 + $Tcance5);
                $cresc_real6 = ($Tnew6 + $Texpan6 + $Tresur6) - ($Tcontr6 + $Tcance6);

                $x++;
            }
            mysqli_free_result($consulta);
            mysqli_close($con);
            if ($x == 0) {
                echo "<br><br><font style='Arial' size='3' color='red'>Não há dados de pagamentos nesses período!<br><br><br>";
            }

            $chart = new LineChartEstat2(800, 300);

            $serie1 = new XYDataSet();
            $serie1->addPoint(new Point(date("M/Y", strtotime("-6 month", $date)), $Tnew6));
            $serie1->addPoint(new Point(date("M/Y", strtotime("-5 month", $date)), $Tnew5));
            $serie1->addPoint(new Point(date("M/Y", strtotime("-4 month", $date)), $Tnew4));
            $serie1->addPoint(new Point(date("M/Y", strtotime("-3 month", $date)), $Tnew3));
            $serie1->addPoint(new Point(date("M/Y", strtotime("-2 month", $date)), $Tnew2));
            $serie1->addPoint(new Point(date("M/Y", strtotime("-1 month", $date)), $Tnew1));
            $serie1->addPoint(new Point(date("M/Y", strtotime("-0 month", $date)), $Tnew0));

            $serie2 = new XYDataSet();
            $serie2->addPoint(new Point(date("M/Y", strtotime("-6 month", $date)), $Texpan6));
            $serie2->addPoint(new Point(date("M/Y", strtotime("-5 month", $date)), $Texpan5));
            $serie2->addPoint(new Point(date("M/Y", strtotime("-4 month", $date)), $Texpan4));
            $serie2->addPoint(new Point(date("M/Y", strtotime("-3 month", $date)), $Texpan3));
            $serie2->addPoint(new Point(date("M/Y", strtotime("-2 month", $date)), $Texpan2));
            $serie2->addPoint(new Point(date("M/Y", strtotime("-1 month", $date)), $Texpan1));
            $serie2->addPoint(new Point(date("M/Y", strtotime("-0 month", $date)), $Texpan0));

            $serie3 = new XYDataSet();
            $serie3->addPoint(new Point(date("M/Y", strtotime("-6 month", $date)), $Tresur6));
            $serie3->addPoint(new Point(date("M/Y", strtotime("-5 month", $date)), $Tresur5));
            $serie3->addPoint(new Point(date("M/Y", strtotime("-4 month", $date)), $Tresur4));
            $serie3->addPoint(new Point(date("M/Y", strtotime("-3 month", $date)), $Tresur3));
            $serie3->addPoint(new Point(date("M/Y", strtotime("-2 month", $date)), $Tresur2));
            $serie3->addPoint(new Point(date("M/Y", strtotime("-1 month", $date)), $Tresur1));
            $serie3->addPoint(new Point(date("M/Y", strtotime("-0 month", $date)), $Tresur0));

            $serie4 = new XYDataSet();
            $serie4->addPoint(new Point(date("M/Y", strtotime("-6 month", $date)), $Tcontr6));
            $serie4->addPoint(new Point(date("M/Y", strtotime("-5 month", $date)), $Tcontr5));
            $serie4->addPoint(new Point(date("M/Y", strtotime("-4 month", $date)), $Tcontr4));
            $serie4->addPoint(new Point(date("M/Y", strtotime("-3 month", $date)), $Tcontr3));
            $serie4->addPoint(new Point(date("M/Y", strtotime("-2 month", $date)), $Tcontr2));
            $serie4->addPoint(new Point(date("M/Y", strtotime("-1 month", $date)), $Tcontr1));
            $serie4->addPoint(new Point(date("M/Y", strtotime("-0 month", $date)), $Tcontr0));

            $serie5 = new XYDataSet();
            $serie5->addPoint(new Point(date("M/Y", strtotime("-6 month", $date)), $Tcance6));
            $serie5->addPoint(new Point(date("M/Y", strtotime("-5 month", $date)), $Tcance5));
            $serie5->addPoint(new Point(date("M/Y", strtotime("-4 month", $date)), $Tcance4));
            $serie5->addPoint(new Point(date("M/Y", strtotime("-3 month", $date)), $Tcance3));
            $serie5->addPoint(new Point(date("M/Y", strtotime("-2 month", $date)), $Tcance2));
            $serie5->addPoint(new Point(date("M/Y", strtotime("-1 month", $date)), $Tcance1));
            $serie5->addPoint(new Point(date("M/Y", strtotime("-0 month", $date)), $Tcance0));

            $serie6 = new XYDataSet();
            $serie6->addPoint(new Point(date("M/Y", strtotime("-6 month", $date)), $cresc_real6));
            $serie6->addPoint(new Point(date("M/Y", strtotime("-5 month", $date)), $cresc_real5));
            $serie6->addPoint(new Point(date("M/Y", strtotime("-4 month", $date)), $cresc_real4));
            $serie6->addPoint(new Point(date("M/Y", strtotime("-3 month", $date)), $cresc_real3));
            $serie6->addPoint(new Point(date("M/Y", strtotime("-2 month", $date)), $cresc_real2));
            $serie6->addPoint(new Point(date("M/Y", strtotime("-1 month", $date)), $cresc_real1));
            $serie6->addPoint(new Point(date("M/Y", strtotime("-0 month", $date)), $cresc_real0));

            $dataSet = new XYSeriesDataSet();
            $dataSet->addSerie("New", $serie1);
            $dataSet->addSerie("Expan", $serie2);
            $dataSet->addSerie("Resur", $serie3);
            $dataSet->addSerie("Contr", $serie4);
            $dataSet->addSerie("Cance", $serie5);
            $dataSet->addSerie("Real", $serie6);
            $chart->setDataSet($dataSet);

            $chart->setTitle("Evolução Mensal de Crescimento (R$)");
            $chart->getPlot()->setGraphCaptionRatio(0.62);
            $chart->render("imagens/grafico/evolucao_mrr.png");


            $chart = new VerticalBarChartEstat(800, 300);

            $serie1 = new XYDataSet();
            $serie1->addPoint(new Point("MRR", $Tmrr1));
            $serie1->addPoint(new Point("New", $Tnew1));
            $serie1->addPoint(new Point("Expan", $Texpan1));
            $serie1->addPoint(new Point("Ressu", $Tresur1));
            $serie1->addPoint(new Point("Contr", $Tcontr1));
            $serie1->addPoint(new Point("Cance", $Tcance1));

            $serie2 = new XYDataSet();
            $serie2->addPoint(new Point("MRR", $Tmrr0));
            $serie2->addPoint(new Point("New", $Tnew0));
            $serie2->addPoint(new Point("Expan", $Texpan0));
            $serie2->addPoint(new Point("Ressu", $Tresur0));
            $serie2->addPoint(new Point("Contr", $Tcontr0));
            $serie2->addPoint(new Point("Cance", $Tcance0));

            $dataSet = new XYSeriesDataSet();
            $dataSet->addSerie(date("M/Y", strtotime("-1 month", $date)), $serie1);
            $dataSet->addSerie(date("M/Y", strtotime("-0 month", $date)), $serie2);
            $chart->setDataSet($dataSet);
            $chart->getPlot()->setGraphCaptionRatio(0.65);

            $chart->setTitle("Quadro Comparativo Mensal (R$)");
            $chart->render("imagens/grafico/quadro_mrr.png");
            ?><br>
            <img alt='Métricas SaaS' src='imagens/grafico/evolucao_mrr.png' style='border: 1px solid gray;'>
            <br><br>
            <img alt='Métricas SaaS' src='imagens/grafico/quadro_mrr.png' style='border: 1px solid gray;'>
            <br><br>
            <table border="1" cellpadding="0" cellspacing="0"
                   style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
                <tr height="30" bgcolor="#f0f8ff">
                    <td width='150' align="center">Métricas</td>
                    <td width='100' align="center"><?php echo date("M/Y", strtotime("-1 month", $date)); ?></td>
                    <td width='100' align="center"><?php echo date("M/Y", strtotime("-0 month", $date)); ?></td>
                    <td width='100' align="center">Evolução</td>
                    <td width='100' align="center">Por Área</td>
                </tr>
                <tr height="30">
                    <td align="left">&nbsp;MRR</td>
                    <td align="center"><?php echo $Tmrr1; ?></td>
                    <td align="center"><?php echo $Tmrr0; ?></td>
                    <td align="center"><?php echo $Tmrr0 - $Tmrr1; ?></td>
                    <td width='100' align="center"><a
                                onclick="return pesquisar('analitico.php?mrr&mes=<?php echo $_POST['mes'] ?>&ano=<?php echo $_POST['ano'] ?>', 520, 590)"
                                href="#"><img src="imagens/site/src.png" title="Ver mais..."></td>
                </tr>
                <tr height="30" bgcolor="#f5fcff">
                    <td align="left">&nbsp;New MRR</td>
                    <td align="center"><?php echo $Tnew1; ?></td>
                    <td align="center"><?php echo $Tnew0; ?></td>
                    <td align="center"><?php echo $Tnew0 - $Tnew1; ?></td>
                    <td width='100' align="center"><a
                                onclick="return pesquisar('analitico.php?new&mes=<?php echo $_POST['mes'] ?>&ano=<?php echo $_POST['ano'] ?>', 520, 590)"
                                href="#"><img src="imagens/site/src.png" title="Ver mais..."></td>
                </tr>
                <tr height="30">
                    <td align="left">&nbsp;Expansion MRR</td>
                    <td align="center"><?php echo $Texpan1; ?></td>
                    <td align="center"><?php echo $Texpan0; ?></td>
                    <td align="center"><?php echo $Texpan0 - $Texpan1; ?></td>
                    <td width='100' align="center"><a
                                onclick="return pesquisar('analitico.php?expan&mes=<?php echo $_POST['mes'] ?>&ano=<?php echo $_POST['ano'] ?>', 520, 590)"
                                href="#"><img src="imagens/site/src.png" title="Ver mais..."></td>
                </tr>
                <tr height="30" bgcolor="#f5fcff">
                    <td align="left">&nbsp;Resurrected MRR</td>
                    <td align="center"><?php echo $Tresur1; ?></td>
                    <td align="center"><?php echo $Tresur0; ?></td>
                    <td align="center"><?php echo $Tresur0 - $Tresur1; ?></td>
                    <td width='100' align="center"><a
                                onclick="return pesquisar('analitico.php?resur&mes=<?php echo $_POST['mes'] ?>&ano=<?php echo $_POST['ano'] ?>', 520, 590)"
                                href="#"><img src="imagens/site/src.png" title="Ver mais..."></td>
                </tr>
                <tr height="30">
                    <td align="left">&nbsp;Contration MRR</td>
                    <td align="center"><?php echo $Tcontr1; ?></td>
                    <td align="center"><?php echo $Tcontr0; ?></td>
                    <td align="center"><?php echo $Tcontr0 - $Tcontr1; ?></td>
                    <td width='100' align="center"><a
                                onclick="return pesquisar('analitico.php?contr&mes=<?php echo $_POST['mes'] ?>&ano=<?php echo $_POST['ano'] ?>', 520, 590)"
                                href="#"><img src="imagens/site/src.png" title="Ver mais..."></td>
                </tr>
                <tr height="30" bgcolor="#f5fcff">
                    <td align="left">&nbsp;Cancelled MRR</td>
                    <td align="center"><?php echo $Tcance1; ?></td>
                    <td align="center"><?php echo $Tcance0; ?></td>
                    <td align="center"><?php echo $Tcance0 - $Tcance1; ?></td>
                    <td width='100' align="center"><a
                                onclick="return pesquisar('analitico.php?cance&mes=<?php echo $_POST['mes'] ?>&ano=<?php echo $_POST['ano'] ?>', 520, 590)"
                                href="#"><img src="imagens/site/src.png" title="Ver mais..."></td>
                </tr>
            </table><br><br><br>
            <?php
        }
    } else {
        echo "<br><br><img src='imagens/site/estatistica.png'>";
    }
?>
</center><br>