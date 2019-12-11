<center><br>
<form action='pagamento.php' method='POST'>
    <font color="#00008b" size="2">Escolha um mês e um ano</font>
    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
        <tr height="40" bgcolor="#f0f8ff">
            <td width="40" align="right">Mês&nbsp;</td>
            <td width="90" align="center">
                <select name="mes" autofocus>
                    <option value="00">Selecione</option>
                    <?php
                    for ($mes=1;$mes<13;$mes++) { ?>
                        <option value="<?php echo str_pad($mes, 2, '0', STR_PAD_LEFT) ?>" <?php if (isset($_POST['mes'])) {
                            if ($_POST['mes'] == str_pad($mes, 2, '0', STR_PAD_LEFT)) {
                                echo "selected";
                            }
                        } ?>><?php echo str_ireplace($mesEN, $mesPT, date('F', strtotime("01-" . $mes . "-1970"))) ?></option>
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
                    for ($ano=idate('Y');$ano>(idate('Y')-5);$ano--) { ?>
                        <option value="<?php echo $ano ?>" <?php if (isset($_POST['ano'])) {
                            if ($_POST['ano'] == $ano) {
                                echo "selected";
                            }
                        } ?>><?php echo $ano ?></option>
                        <?php
                    }
                    ?>
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