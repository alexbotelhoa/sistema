<center><br>
<form action='pagamento.php' method='POST'>
    <font color="#00008b" size="2">Escolha um mês e um ano</font>
    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
        <tr height="40" bgcolor="#f0f8ff">
            <td width="40" align="right">Mês&nbsp;</td>
            <td width="90" align="center">
                <select name="mes" autofocus>
                    <option value="00">Selecione</option>
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
</form><br>
<?php
    if (isset($_POST['search'])) {
        if ($_POST['mes'] == "0" or $_POST['ano'] == "0") {
            echo "<br><br><font style='Arial' size='3' color='red'>Você NÃO selecionou um MÊS e/ou um ANO!</font>";
            echo "<meta http-equiv='refresh' content='2;URL=pagamento.php'>";
        } else {
            $url = "https://demo4417994.mockable.io/clientes/";
            $baseclientes = json_decode(file_get_contents($url));

            $sql = "
                SELECT pag_cliente_id, GROUP_CONCAT(CONCAT_WS(',', pag_data, pag_reco, round((pag_pago/pag_reco))) ORDER BY pag_data ASC SEPARATOR '/') as informacoes, count(1) as contador
                FROM sm_pagamentos
                WHERE pag_data BETWEEN ADDDATE('" . $_POST['ano'] . "-" . $_POST['mes'] . "-01', INTERVAL -6 MONTH) AND '" . $_POST['ano'] . "-" . $_POST['mes'] . "-31'
                GROUP BY pag_cliente_id
                ORDER BY pag_cliente_id ASC
                ";
            $consulta = mysqli_query($con, $sql) or die ("<font style=Arial color=red>Houve um erro na consulta 1 dos dados</font>");
            $x = 0;
            $date = strtotime($_POST['ano'] . "-" . $_POST['mes'] . "-01");

            while ($dados = mysqli_fetch_array($consulta)) {
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

                $cli_selec[] = [$dados['pag_cliente_id'], $mes[6], $mes[5], $mes[4], $mes[3], $mes[2], $mes[1], $mes[0]];
                $x++;
            }
            mysqli_free_result($consulta);
            mysqli_close($con);

            if ($x == 0) {
                echo "<br><br><font style='Arial' size='3' color='red'>Não há dados de pagamentos nesses período!</font>";
            }

            $cli_filtro = array_replace($cli_selec, array_intersect_key($baseclientes, $cli_selec));
            $segmento = array(array_values($cli_filtro));
            for ($s = 0; $s < (count($segmento, 1) - 1); $s++) {
                $seg1[] = $segmento[0][$s]->nome;
            }

            $d = 0;
            while (current($seg1)) {
                $clientes[] = [$seg1[$d], $cli_selec[$d][1], $cli_selec[$d][2], $cli_selec[$d][3], $cli_selec[$d][4], $cli_selec[$d][5], $cli_selec[$d][6], $cli_selec[$d][7]];
                next($seg1);
                $d++;
            }
            ?>
            <table border="1" cellpadding="0" cellspacing="0"
                   style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
                <tr height="30" bgcolor="#f0f8ff">
                    <td width='120' align="center">Nome</td>
                    <td width='80' align="center"><?php echo date("M/Y", strtotime("-6 month", $date)) ?></td>
                    <td width='80' align="center"><?php echo date("M/Y", strtotime("-5 month", $date)) ?></td>
                    <td width='80' align="center"><?php echo date("M/Y", strtotime("-4 month", $date)) ?></td>
                    <td width='80' align="center"><?php echo date("M/Y", strtotime("-3 month", $date)) ?></td>
                    <td width='80' align="center"><?php echo date("M/Y", strtotime("-2 month", $date)) ?></td>
                    <td width='80' align="center"><?php echo date("M/Y", strtotime("-1 month", $date)) ?></td>
                    <td width='80' align="center"><?php echo date("M/Y", strtotime("-0 month", $date)) ?></td>
                </tr>
                <?php
                for ($c = 0; $c < count($clientes); $c++) {
                    ?>
                    <tr height="20" <?php if ($c % 2 == 1) {
                        echo 'bgcolor=#f5fcff';
                    } ?>>
                        <td align='center'><?php echo $clientes[$c][0] ?></td>
                        <td align='center'><?php echo number_format($clientes[$c][1], 2, ',', '.') ?></td>
                        <td align='center'><?php echo number_format($clientes[$c][2], 2, ',', '.') ?></td>
                        <td align='center'><?php echo number_format($clientes[$c][3], 2, ',', '.') ?></td>
                        <td align='center'><?php echo number_format($clientes[$c][4], 2, ',', '.') ?></td>
                        <td align='center'><?php echo number_format($clientes[$c][5], 2, ',', '.') ?></td>
                        <td align='center'><?php echo number_format($clientes[$c][6], 2, ',', '.') ?></td>
                        <td align='center'><?php echo number_format($clientes[$c][7], 2, ',', '.') ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table><br><br><br>
            <?php
        }
    } else {
        echo "<br><br><img src='imagens/site/pagamento.png'>";
    }
?>
</center>
<br>