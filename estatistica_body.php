<center><br>
    <form action='estatistica.php' method='POST'>
        <font color="#00008b" size="2">Escolha um mês e um ano</font>
        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
            <tr height="40" bgcolor="#f0f8ff">
                <td width="40" align="right">Mês&nbsp;</td>
                <td width="90" align="center">
                    <select name="mes" autofocus>
                        <option value="00">Selecione</option>
                        <?php
                        for ($mesSelect=1;$mesSelect<13;$mesSelect++) { ?>
                            <option value="<?php echo str_pad($mesSelect, 2, '0', STR_PAD_LEFT) ?>" <?php if (isset($_POST['mes'])) {
                                if ($_POST['mes'] == str_pad($mesSelect, 2, '0', STR_PAD_LEFT)) {
                                    echo "selected";
                                }
                            } ?>><?php echo str_ireplace($mesEN, $mesPT, date('F', strtotime("01-" . $mesSelect . "-1970"))) ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
                <td width="40" align="right">Ano&nbsp;</td>
                <td width="90" align="center">
                    <select name="ano">
                        <option value="0000">Selecione</option>
                        <?php
                        for ($anoSelect=idate('Y');$anoSelect>(idate('Y')-5);$anoSelect--) { ?>
                            <option value="<?php echo $anoSelect ?>" <?php if (isset($_POST['ano'])) {
                                if ($_POST['ano'] == $anoSelect) {
                                    echo "selected";
                                }
                            } ?>><?php echo $anoSelect ?></option>
                            <?php
                        }
                        ?>
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
                WHERE pag_data BETWEEN ADDDATE('$_POST[ano]-$_POST[mes]-01', INTERVAL -18 MONTH) AND '$_POST[ano]-$_POST[mes]-31'
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

            $Tmrr7 = 0;
            $Tnew7 = 0;
            $Texpan7 = 0;
            $Tresur7 = 0;
            $Tcontr7 = 0;
            $Tcance7 = 0;

            $Tmrr8 = 0;
            $Tnew8 = 0;
            $Texpan8 = 0;
            $Tresur8 = 0;
            $Tcontr8 = 0;
            $Tcance8 = 0;

            $Tmrr9 = 0;
            $Tnew9 = 0;
            $Texpan9 = 0;
            $Tresur9 = 0;
            $Tcontr9 = 0;
            $Tcance9 = 0;

            $Tmrr10 = 0;
            $Tnew10 = 0;
            $Texpan10 = 0;
            $Tresur10 = 0;
            $Tcontr10 = 0;
            $Tcance10 = 0;

            $Tmrr11 = 0;
            $Tnew11 = 0;
            $Texpan11 = 0;
            $Tresur11 = 0;
            $Tcontr11 = 0;
            $Tcance11 = 0;

            $qp0 = 0;
            $qc0 = 0;
            $qp1 = 0;
            $qc1 = 0;

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
                $mes[12] = 0;

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
                    $Tmrr0 = $Tmrr0 + $mes[0]; $qp0++;
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
                    $Tcance0 = $Tcance0 + $mes[1]; $qc0++;
                }


                if ($mes[1] != 0) {
                    $Tmrr1 = $Tmrr1 + $mes[1]; $qp1++;
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
                    $Tcance1 = $Tcance1 + $mes[2]; $qc1++;
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


                if ($mes[7] != 0) {
                    $Tmrr7 = $Tmrr7 + $mes[7];
                }
                if ($mes[7] != 0 and $dados['contador'] == 1) {
                    $Tnew7 = $Tnew7 + $mes[7];
                }
                if ($mes[7] != 0 and $mes[8] != 0 and $mes[7] > $mes[8]) {
                    $Texpan7 = $Texpan7 + ($mes[7] - $mes[8]);
                }
                if ($mes[7] != 0 and $mes[8] == 0 and $dados['contador'] > ($rs + 1)) {
                    $Tresur7 = $Tresur7 + $mes[7];
                    $rs++;
                }
                if ($mes[7] != 0 and $mes[8] != 0 and $mes[7] < $mes[8]) {
                    $Tcontr7 = $Tcontr7 + ($mes[8] - $mes[7]);
                }
                if ($mes[7] == 0 and $mes[8] != 0) {
                    $Tcance7 = $Tcance7 + $mes[8];
                }


                if ($mes[8] != 0) {
                    $Tmrr8 = $Tmrr8 + $mes[8];
                }
                if ($mes[8] != 0 and $dados['contador'] == 1) {
                    $Tnew8 = $Tnew8 + $mes[8];
                }
                if ($mes[8] != 0 and $mes[9] != 0 and $mes[8] > $mes[9]) {
                    $Texpan8 = $Texpan8 + ($mes[8] - $mes[9]);
                }
                if ($mes[8] != 0 and $mes[9] == 0 and $dados['contador'] > ($rs + 1)) {
                    $Tresur8 = $Tresur8 + $mes[6];
                    $rs++;
                }
                if ($mes[8] != 0 and $mes[9] != 0 and $mes[8] < $mes[9]) {
                    $Tcontr8 = $Tcontr8 + ($mes[9] - $mes[8]);
                }
                if ($mes[8] == 0 and $mes[9] != 0) {
                    $Tcance8 = $Tcance8 + $mes[9];
                }


                if ($mes[9] != 0) {
                    $Tmrr9 = $Tmrr9 + $mes[9];
                }
                if ($mes[9] != 0 and $dados['contador'] == 1) {
                    $Tnew9 = $Tnew9 + $mes[9];
                }
                if ($mes[9] != 0 and $mes[10] != 0 and $mes[9] > $mes[10]) {
                    $Texpan9 = $Texpan9 + ($mes[6] - $mes[10]);
                }
                if ($mes[9] != 0 and $mes[10] == 0 and $dados['contador'] > ($rs + 1)) {
                    $Tresur9 = $Tresur9 + $mes[9];
                    $rs++;
                }
                if ($mes[9] != 0 and $mes[10] != 0 and $mes[9] < $mes[10]) {
                    $Tcontr9 = $Tcontr9 + ($mes[10] - $mes[9]);
                }
                if ($mes[9] == 0 and $mes[10] != 0) {
                    $Tcance9 = $Tcance9 + $mes[10];
                }


                if ($mes[10] != 0) {
                    $Tmrr10 = $Tmrr10 + $mes[10];
                }
                if ($mes[10] != 0 and $dados['contador'] == 1) {
                    $Tnew10 = $Tnew10 + $mes[10];
                }
                if ($mes[10] != 0 and $mes[11] != 0 and $mes[10] > $mes[11]) {
                    $Texpan10 = $Texpan10 + ($mes[10] - $mes[11]);
                }
                if ($mes[10] != 0 and $mes[11] == 0 and $dados['contador'] > ($rs + 1)) {
                    $Tresur10 = $Tresur10 + $mes[10];
                    $rs++;
                }
                if ($mes[10] != 0 and $mes[11] != 0 and $mes[10] < $mes[11]) {
                    $Tcontr10 = $Tcontr10 + ($mes[11] - $mes[10]);
                }
                if ($mes[10] == 0 and $mes[11] != 0) {
                    $Tcance10 = $Tcance10 + $mes[11];
                }


                if ($mes[11] != 0) {
                    $Tmrr11 = $Tmrr11 + $mes[11];
                }
                if ($mes[11] != 0 and $dados['contador'] == 1) {
                    $Tnew11 = $Tnew11 + $mes[11];
                }
                if ($mes[11] != 0 and $mes[12] != 0 and $mes[11] > $mes[12]) {
                    $Texpan11 = $Texpan11 + ($mes[11] - $mes[12]);
                }
                if ($mes[11] != 0 and $mes[12] == 0 and $dados['contador'] > ($rs + 1)) {
                    $Tresur11 = $Tresur11 + $mes[11];
                    $rs++;
                }
                if ($mes[11] != 0 and $mes[12] != 0 and $mes[11] < $mes[12]) {
                    $Tcontr11 = $Tcontr11 + ($mes[12] - $mes[11]);
                }
                if ($mes[11] == 0 and $mes[12] != 0) {
                    $Tcance11 = $Tcance11 + $mes[12];
                }

                $x++;
            }

            $cresc_real0 = ($Tnew0 + $Texpan0 + $Tresur0) - ($Tcontr0 + $Tcance0);
            $cresc_real1 = ($Tnew1 + $Texpan1 + $Tresur1) - ($Tcontr1 + $Tcance1);
            $cresc_real2 = ($Tnew2 + $Texpan2 + $Tresur2) - ($Tcontr2 + $Tcance2);
            $cresc_real3 = ($Tnew3 + $Texpan3 + $Tresur3) - ($Tcontr3 + $Tcance3);
            $cresc_real4 = ($Tnew4 + $Texpan4 + $Tresur4) - ($Tcontr4 + $Tcance4);
            $cresc_real5 = ($Tnew5 + $Texpan5 + $Tresur5) - ($Tcontr5 + $Tcance5);
            $cresc_real6 = ($Tnew6 + $Texpan6 + $Tresur6) - ($Tcontr6 + $Tcance6);
            $cresc_real7 = ($Tnew7 + $Texpan7 + $Tresur7) - ($Tcontr7 + $Tcance7);
            $cresc_real8 = ($Tnew8 + $Texpan8 + $Tresur8) - ($Tcontr8 + $Tcance8);
            $cresc_real9 = ($Tnew9 + $Texpan9 + $Tresur9) - ($Tcontr9 + $Tcance9);
            $cresc_real10 = ($Tnew10 + $Texpan10 + $Tresur10) - ($Tcontr10 + $Tcance10);
            $cresc_real11 = ($Tnew11 + $Texpan11 + $Tresur11) - ($Tcontr11 + $Tcance11);


            if ($qp0 != 0) {
                $Tarpu0 = $Tmrr0 / $qp0;
                $Tchurn0 = ($qc0 * 100) / $qp0;
            }else {
                $Tarpu0 = 0;
                $Tchurn0 = 0;
            }
            $Tltv0 = 0;

            if ($qp1 != 0) {
                $Tarpu1 = $Tmrr1 / $qp1;
                $Tchurn1 = ($qc1 * 100) / $qp1;
            }else {
                $Tarpu1 = 0;
                $Tchurn1 = 0;
            }
            $Tltv1 = 0;


            mysqli_free_result($consulta);
            mysqli_close($con);
            if ($x == 0) {
                echo "<br><br><font style='Arial' size='3' color='red'>Não há dados de pagamentos nesses período!<br><br><br>";
            } else {


                $chart = new VerticalBarChartEstat2(800, 300);
                $dataSet = new XYDataSet();
                $dataSet->addPoint(new Point(date("M/Y", strtotime("-11 month", $date)), $Tmrr11));
                $dataSet->addPoint(new Point(date("M/Y", strtotime("-10 month", $date)), $Tmrr10));
                $dataSet->addPoint(new Point(date("M/Y", strtotime("-9 month", $date)), $Tmrr9));
                $dataSet->addPoint(new Point(date("M/Y", strtotime("-8 month", $date)), $Tmrr8));
                $dataSet->addPoint(new Point(date("M/Y", strtotime("-7 month", $date)), $Tmrr7));
                $dataSet->addPoint(new Point(date("M/Y", strtotime("-6 month", $date)), $Tmrr6));
                $dataSet->addPoint(new Point(date("M/Y", strtotime("-5 month", $date)), $Tmrr5));
                $dataSet->addPoint(new Point(date("M/Y", strtotime("-4 month", $date)), $Tmrr4));
                $dataSet->addPoint(new Point(date("M/Y", strtotime("-3 month", $date)), $Tmrr3));
                $dataSet->addPoint(new Point(date("M/Y", strtotime("-2 month", $date)), $Tmrr2));
                $dataSet->addPoint(new Point(date("M/Y", strtotime("-1 month", $date)), $Tmrr1));
                $dataSet->addPoint(new Point(date("M/Y", strtotime("-0 month", $date)), $Tmrr0));
                $chart->setDataSet($dataSet);
                $chart->setTitle("Evolução Anual de MRR");
                $chart->render("imagens/grafico/evolucao_meses_mrr.png");


                $chart = new LineChartEstat2(800, 300);

                $serie1 = new XYDataSet();
                $serie1->addPoint(new Point(date("M/Y", strtotime("-11 month", $date)), $Tnew11));
                $serie1->addPoint(new Point(date("M/Y", strtotime("-10 month", $date)), $Tnew10));
                $serie1->addPoint(new Point(date("M/Y", strtotime("-9 month", $date)), $Tnew9));
                $serie1->addPoint(new Point(date("M/Y", strtotime("-8 month", $date)), $Tnew8));
                $serie1->addPoint(new Point(date("M/Y", strtotime("-7 month", $date)), $Tnew7));
                $serie1->addPoint(new Point(date("M/Y", strtotime("-6 month", $date)), $Tnew6));
                $serie1->addPoint(new Point(date("M/Y", strtotime("-5 month", $date)), $Tnew5));
                $serie1->addPoint(new Point(date("M/Y", strtotime("-4 month", $date)), $Tnew4));
                $serie1->addPoint(new Point(date("M/Y", strtotime("-3 month", $date)), $Tnew3));
                $serie1->addPoint(new Point(date("M/Y", strtotime("-2 month", $date)), $Tnew2));
                $serie1->addPoint(new Point(date("M/Y", strtotime("-1 month", $date)), $Tnew1));
                $serie1->addPoint(new Point(date("M/Y", strtotime("-0 month", $date)), $Tnew0));

                $serie2 = new XYDataSet();
                $serie2->addPoint(new Point(date("M/Y", strtotime("-11 month", $date)), $Texpan11));
                $serie2->addPoint(new Point(date("M/Y", strtotime("-10 month", $date)), $Texpan10));
                $serie2->addPoint(new Point(date("M/Y", strtotime("-9 month", $date)), $Texpan9));
                $serie2->addPoint(new Point(date("M/Y", strtotime("-8 month", $date)), $Texpan8));
                $serie2->addPoint(new Point(date("M/Y", strtotime("-7 month", $date)), $Texpan7));
                $serie2->addPoint(new Point(date("M/Y", strtotime("-6 month", $date)), $Texpan6));
                $serie2->addPoint(new Point(date("M/Y", strtotime("-5 month", $date)), $Texpan5));
                $serie2->addPoint(new Point(date("M/Y", strtotime("-4 month", $date)), $Texpan4));
                $serie2->addPoint(new Point(date("M/Y", strtotime("-3 month", $date)), $Texpan3));
                $serie2->addPoint(new Point(date("M/Y", strtotime("-2 month", $date)), $Texpan2));
                $serie2->addPoint(new Point(date("M/Y", strtotime("-1 month", $date)), $Texpan1));
                $serie2->addPoint(new Point(date("M/Y", strtotime("-0 month", $date)), $Texpan0));

                $serie3 = new XYDataSet();
                $serie3->addPoint(new Point(date("M/Y", strtotime("-11 month", $date)), $Tresur11));
                $serie3->addPoint(new Point(date("M/Y", strtotime("-10 month", $date)), $Tresur10));
                $serie3->addPoint(new Point(date("M/Y", strtotime("-9 month", $date)), $Tresur9));
                $serie3->addPoint(new Point(date("M/Y", strtotime("-8 month", $date)), $Tresur8));
                $serie3->addPoint(new Point(date("M/Y", strtotime("-7 month", $date)), $Tresur7));
                $serie3->addPoint(new Point(date("M/Y", strtotime("-6 month", $date)), $Tresur6));
                $serie3->addPoint(new Point(date("M/Y", strtotime("-5 month", $date)), $Tresur5));
                $serie3->addPoint(new Point(date("M/Y", strtotime("-4 month", $date)), $Tresur4));
                $serie3->addPoint(new Point(date("M/Y", strtotime("-3 month", $date)), $Tresur3));
                $serie3->addPoint(new Point(date("M/Y", strtotime("-2 month", $date)), $Tresur2));
                $serie3->addPoint(new Point(date("M/Y", strtotime("-1 month", $date)), $Tresur1));
                $serie3->addPoint(new Point(date("M/Y", strtotime("-0 month", $date)), $Tresur0));

                $serie4 = new XYDataSet();
                $serie4->addPoint(new Point(date("M/Y", strtotime("-11 month", $date)), $Tcontr11));
                $serie4->addPoint(new Point(date("M/Y", strtotime("-10 month", $date)), $Tcontr10));
                $serie4->addPoint(new Point(date("M/Y", strtotime("-9 month", $date)), $Tcontr9));
                $serie4->addPoint(new Point(date("M/Y", strtotime("-8 month", $date)), $Tcontr8));
                $serie4->addPoint(new Point(date("M/Y", strtotime("-7 month", $date)), $Tcontr7));
                $serie4->addPoint(new Point(date("M/Y", strtotime("-6 month", $date)), $Tcontr6));
                $serie4->addPoint(new Point(date("M/Y", strtotime("-5 month", $date)), $Tcontr5));
                $serie4->addPoint(new Point(date("M/Y", strtotime("-4 month", $date)), $Tcontr4));
                $serie4->addPoint(new Point(date("M/Y", strtotime("-3 month", $date)), $Tcontr3));
                $serie4->addPoint(new Point(date("M/Y", strtotime("-2 month", $date)), $Tcontr2));
                $serie4->addPoint(new Point(date("M/Y", strtotime("-1 month", $date)), $Tcontr1));
                $serie4->addPoint(new Point(date("M/Y", strtotime("-0 month", $date)), $Tcontr0));

                $serie5 = new XYDataSet();
                $serie5->addPoint(new Point(date("M/Y", strtotime("-11 month", $date)), $Tcance11));
                $serie5->addPoint(new Point(date("M/Y", strtotime("-10 month", $date)), $Tcance10));
                $serie5->addPoint(new Point(date("M/Y", strtotime("-9 month", $date)), $Tcance9));
                $serie5->addPoint(new Point(date("M/Y", strtotime("-8 month", $date)), $Tcance8));
                $serie5->addPoint(new Point(date("M/Y", strtotime("-7 month", $date)), $Tcance7));
                $serie5->addPoint(new Point(date("M/Y", strtotime("-6 month", $date)), $Tcance6));
                $serie5->addPoint(new Point(date("M/Y", strtotime("-5 month", $date)), $Tcance5));
                $serie5->addPoint(new Point(date("M/Y", strtotime("-4 month", $date)), $Tcance4));
                $serie5->addPoint(new Point(date("M/Y", strtotime("-3 month", $date)), $Tcance3));
                $serie5->addPoint(new Point(date("M/Y", strtotime("-2 month", $date)), $Tcance2));
                $serie5->addPoint(new Point(date("M/Y", strtotime("-1 month", $date)), $Tcance1));
                $serie5->addPoint(new Point(date("M/Y", strtotime("-0 month", $date)), $Tcance0));

                $serie6 = new XYDataSet();
                $serie6->addPoint(new Point(date("M/Y", strtotime("-11 month", $date)), $cresc_real11));
                $serie6->addPoint(new Point(date("M/Y", strtotime("-10 month", $date)), $cresc_real10));
                $serie6->addPoint(new Point(date("M/Y", strtotime("-9 month", $date)), $cresc_real9));
                $serie6->addPoint(new Point(date("M/Y", strtotime("-8 month", $date)), $cresc_real8));
                $serie6->addPoint(new Point(date("M/Y", strtotime("-7 month", $date)), $cresc_real7));
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
                $chart->getPlot()->setGraphCaptionRatio(0.66);
                $chart->render("imagens/grafico/evolucao_mes_cresc.png");


                $chart = new LineChart();

                $serie1 = new XYDataSet();
                $serie1->addPoint(new Point("06-01", 273));
                $serie1->addPoint(new Point("06-02", 421));
                $serie1->addPoint(new Point("06-03", 642));
                $serie1->addPoint(new Point("06-04", 799));
                $serie1->addPoint(new Point("06-05", 1009));
                $serie1->addPoint(new Point("06-06", 1106));

                $serie2 = new XYDataSet();
                $serie2->addPoint(new Point("06-01", 280));
                $serie2->addPoint(new Point("06-02", 300));
                $serie2->addPoint(new Point("06-03", 212));
                $serie2->addPoint(new Point("06-04", 542));
                $serie2->addPoint(new Point("06-05", 600));
                $serie2->addPoint(new Point("06-06", 850));

                $serie3 = new XYDataSet();
                $serie3->addPoint(new Point("06-01", 180));
                $serie3->addPoint(new Point("06-02", 400));
                $serie3->addPoint(new Point("06-03", 512));
                $serie3->addPoint(new Point("06-04", 642));
                $serie3->addPoint(new Point("06-05", 700));
                $serie3->addPoint(new Point("06-06", 900));

                $serie4 = new XYDataSet();
                $serie4->addPoint(new Point("06-01", 280));
                $serie4->addPoint(new Point("06-02", 500));
                $serie4->addPoint(new Point("06-03", 612));
                $serie4->addPoint(new Point("06-04", 742));
                $serie4->addPoint(new Point("06-05", 800));
                $serie4->addPoint(new Point("06-06", 1000));

                $serie5 = new XYDataSet();
                $serie5->addPoint(new Point("06-01", 380));
                $serie5->addPoint(new Point("06-02", 600));
                $serie5->addPoint(new Point("06-03", 712));
                $serie5->addPoint(new Point("06-04", 842));
                $serie5->addPoint(new Point("06-05", 900));
                $serie5->addPoint(new Point("06-06", 1200));

                $dataSet = new XYSeriesDataSet();
                $dataSet->addSerie("Product 1", $serie1);
                $dataSet->addSerie("Product 2", $serie2);
                $dataSet->addSerie("Product 3", $serie3);
                $dataSet->addSerie("Product 4", $serie4);
                $dataSet->addSerie("Product 5", $serie5);
                $chart->setDataSet($dataSet);

                $chart->setTitle("Sales for 2006");
                $chart->getPlot()->setGraphCaptionRatio(0.62);
                $chart->render("imagens/grafico/evolucao_mes_cresc2.png");


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
                $chart->getPlot()->setGraphCaptionRatio(0.68);
                $chart->setTitle("Quadro Comparativo Mensal (R$)");
                $chart->render("imagens/grafico/quadro_comp_mes.png");


                ?><br>
                <img alt='Métricas SaaS' src='imagens/grafico/evolucao_meses_mrr.png' style='border: 1px solid gray;'>
                <br><br>
                <img alt='Métricas SaaS' src='imagens/grafico/evolucao_mes_cresc.png' style='border: 1px solid gray;'>
                <br><br>
                <img alt='Métricas SaaS' src='imagens/grafico/quadro_comp_mes.png' style='border: 1px solid gray;'>
                <br><br>
                <table border="1" cellpadding="0" cellspacing="0"
                       style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
                    <tr height="30" bgcolor="#f0f8ff">
                        <td width='150' align="center">Métricas</td>
                        <td width='120' align="center"><?php echo date("M/Y", strtotime("-1 month", $date)); ?></td>
                        <td width='120' align="center"><?php echo date("M/Y", strtotime("-0 month", $date)); ?></td>
                        <td width='100' align="center">Evolução</td>
                        <td width='100' align="center">Quick Ratio</td>
                        <td width='80' align="center">Gráfico</td>
                    </tr>
                    <tr height="30">
                        <td align="left">&nbsp;MRR</td>
                        <td align="center">R$ <?php echo moeda($Tmrr1); ?></td>
                        <td align="center">R$ <?php echo moeda($Tmrr0); ?></td>
                        <td align="center">R$ <?php echo moeda(($Tmrr0 - $Tmrr1)); ?></td>
                        <td align="center"><?php if (($Tmrr0 - $Tmrr1) != 0 and $Tmrr1 != 0) {
                                echo round((($Tmrr0 - $Tmrr1) * 100) / $Tmrr1, 2);
                            } else {
                                echo round("0", 2);
                            } ?> %
                        </td>
                        <td align="center"><a
                                    onclick="return pesquisar('analitico.php?mrr&mes=<?php echo $_POST['mes'] ?>&ano=<?php echo $_POST['ano'] ?>', 520, 590)"
                                    href="#"><img src="imagens/site/src.png" title="Ver mais..."></td>
                    </tr>
                    <tr height="30" bgcolor="#f5fcff">
                        <td align="left">&nbsp;New MRR</td>
                        <td align="center">R$ <?php echo moeda($Tnew1); ?></td>
                        <td align="center">R$ <?php echo moeda($Tnew0); ?></td>
                        <td align="center">R$ <?php echo moeda(($Tnew0 - $Tnew1)); ?></td>
                        <td align="center"><?php if (($Tnew0 - $Tnew1) != 0 and $Tnew1 != 0) {
                                echo round((($Tnew0 - $Tnew1) * 100) / $Tnew1, 2);
                            } else {
                                echo round("0", 2);
                            } ?> %
                        </td>
                        <td align="center"><a
                                    onclick="return pesquisar('analitico.php?new&mes=<?php echo $_POST['mes'] ?>&ano=<?php echo $_POST['ano'] ?>', 520, 590)"
                                    href="#"><img src="imagens/site/src.png" title="Ver mais..."></td>
                    </tr>
                    <tr height="30">
                        <td align="left">&nbsp;Expansion MRR</td>
                        <td align="center">R$ <?php echo moeda($Texpan1); ?></td>
                        <td align="center">R$ <?php echo moeda($Texpan0); ?></td>
                        <td align="center">R$ <?php echo moeda($Texpan0 - $Texpan1); ?></td>
                        <td align="center"><?php if (($Texpan0 - $Texpan1) != 0 and $Texpan1 != 0) {
                                echo round((($Texpan0 - $Texpan1) * 100) / $Texpan1, 2);
                            } else {
                                echo round("0", 2);
                            } ?> %
                        </td>
                        <td align="center"><a
                                    onclick="return pesquisar('analitico.php?expan&mes=<?php echo $_POST['mes'] ?>&ano=<?php echo $_POST['ano'] ?>', 520, 590)"
                                    href="#"><img src="imagens/site/src.png" title="Ver mais..."></td>
                    </tr>
                    <tr height="30" bgcolor="#f5fcff">
                        <td align="left">&nbsp;Resurrected MRR</td>
                        <td align="center">R$ <?php echo moeda($Tresur1); ?></td>
                        <td align="center">R$ <?php echo moeda($Tresur0); ?></td>
                        <td align="center">R$ <?php echo moeda($Tresur0 - $Tresur1); ?></td>
                        <td align="center"><?php if (($Tresur0 - $Tresur1) != 0 and $Tresur1 != 0) {
                                echo round((($Tresur0 - $Tresur1) * 100) / $Tresur1, 2);
                            } else {
                                echo round("0", 2);
                            } ?> %
                        </td>
                        <td align="center"><a
                                    onclick="return pesquisar('analitico.php?resur&mes=<?php echo $_POST['mes'] ?>&ano=<?php echo $_POST['ano'] ?>', 520, 590)"
                                    href="#"><img src="imagens/site/src.png" title="Ver mais..."></td>
                    </tr>
                    <tr height="30">
                        <td align="left">&nbsp;Contration MRR</td>
                        <td align="center">R$ <?php echo moeda($Tcontr1); ?></td>
                        <td align="center">R$ <?php echo moeda($Tcontr0); ?></td>
                        <td align="center">R$ <?php echo moeda($Tcontr0 - $Tcontr1); ?></td>
                        <td align="center"><?php if (($Tcontr0 - $Tcontr1) != 0 and $Tcontr1 != 0) {
                                echo round((($Tcontr0 - $Tcontr1) * 100) / $Tcontr1, 2);
                            } else {
                                echo round("0", 2);
                            } ?> %
                        </td>
                        <td align="center"><a
                                    onclick="return pesquisar('analitico.php?contr&mes=<?php echo $_POST['mes'] ?>&ano=<?php echo $_POST['ano'] ?>', 520, 590)"
                                    href="#"><img src="imagens/site/src.png" title="Ver mais..."></td>
                    </tr>
                    <tr height="30" bgcolor="#f5fcff">
                        <td align="left">&nbsp;Cancelled MRR</td>
                        <td align="center">R$ <?php echo moeda($Tcance1); ?></td>
                        <td align="center">R$ <?php echo moeda($Tcance0); ?></td>
                        <td align="center">R$ <?php echo moeda($Tcance0 - $Tcance1); ?></td>
                        <td align="center"><?php if (($Tcance0 - $Tcance1) != 0 and $Tcance1 != 0) {
                                echo round((($Tcance0 - $Tcance1) * 100) / $Tcance1, 2);
                            } else {
                                echo round("0", 2);
                            } ?> %
                        </td>
                        <td align="center"><a
                                    onclick="return pesquisar('analitico.php?cance&mes=<?php echo $_POST['mes'] ?>&ano=<?php echo $_POST['ano'] ?>', 520, 590)"
                                    href="#"><img src="imagens/site/src.png" title="Ver mais..."></td>
                    </tr>
                    <tr height="30" bgcolor="#f5fcff">
                        <td align="left">&nbsp;ARPU (Ticket Médio)</td>
                        <td align="center">R$ <?php echo moeda($Tarpu1); ?></td>
                        <td align="center">R$ <?php echo moeda($Tarpu0); ?></td>
                        <td align="center">R$ <?php echo moeda($Tarpu0 - $Tarpu1); ?></td>
                        <td align="center"><?php if (($Tarpu0 - $Tarpu1) != 0 and $Tarpu1 != 0) {
                                echo round((($Tarpu0 - $Tarpu1) * 100) / $Tarpu1, 2);
                            } else {
                                echo round("0", 2);
                            } ?> %
                        </td>
                        <td align="center"><a
                                    onclick="return pesquisar('analitico2.php?arpu&mes=<?php echo $_POST['mes'] ?>&ano=<?php echo $_POST['ano'] ?>', 560, 280)"
                                    href="#"><img src="imagens/site/src.png" title="Ver mais..."></td>
                    </tr>
                    <tr height="30" bgcolor="#f5fcff">
                        <td align="left">&nbsp;Churn</td>
                        <td align="center"><?php if (($Tchurn0 - $Tchurn1) != 0) {
                                echo moeda($Tchurn1);
                            } else {
                                echo round("0", 2);
                            } ?> %
                        </td>
                        <td align="center"><?php if (($Tchurn0 - $Tchurn1) != 0) {
                                echo moeda($Tchurn0);
                            } else {
                                echo round("0", 2);
                            } ?> %
                        </td>
                        <td align="center"><?php if (($Tchurn0 - $Tchurn1) != 0) {
                                echo moeda($Tchurn0 - $Tchurn1);
                            } else {
                                echo round("0", 2);
                            } ?> %
                        </td>
                        <td align="center"><?php if (($Tchurn0 - $Tchurn1) != 0 and $Tchurn1 != 0) {
                                echo round((($Tchurn0 - $Tchurn1) * 100) / $Tchurn1, 2);
                            } else {
                                echo round("0", 2);
                            } ?> %
                        </td>
                        <td align="center"><a
                                    onclick="return pesquisar('analitico2.php?churn&mes=<?php echo $_POST['mes'] ?>&ano=<?php echo $_POST['ano'] ?>', 560, 280)"
                                    href="#"><img src="imagens/site/src.png" title="Ver mais..."></td>
                    </tr>
                    <!--
                <tr height="30" bgcolor="#f5fcff">
                    <td align="left">&nbsp;LTV</td>
                    <td align="center">R$ <?php /*echo moeda($Tltv1); */ ?></td>
                    <td align="center">R$ <?php /*echo moeda($Tltv0); */ ?></td>
                    <td align="center">R$ <?php /*echo moeda($Tltv0 - $Tltv1); */ ?></td>
                    <td align="center"><?php /*if(($Tltv0 - $Tltv1) != 0) { echo round((($Tltv0 - $Tltv1) * 100) / $Tltv1, 2);} else {echo round("0",2);} */ ?> %</td>
                    <td align="center"><a
                                onclick="return pesquisar('analitico2.php?ltv&mes=<?php /*echo $_POST['mes'] */ ?>&ano=<?php /*echo $_POST['ano'] */ ?>', 560, 280)"
                                href="#"><img src="imagens/site/src.png" title="Ver mais..."></td>
                </tr>

-->
                </table><br><br><br>
                <?php
            }
        }
    } else {
        echo "<br><br><img src='imagens/site/estatistica.png'>";
    }
?>
</center><br>