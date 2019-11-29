<center>
<br>
    <form action='pagamento.php' method='POST'>
        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
            <tr height="50" bgcolor="#f0f8ff">
                <td width="40" align="right">Mês&nbsp;</td>
                <td>
                    <select name="mes">
                        <option value="00" <?php if ($_POST['mes']=='00') {echo "selected";}?>>Selecione</option>
                        <option value="01" <?php if ($_POST['mes']=='01') {echo "selected";}?>>Janeiro</option>
                        <option value="02" <?php if ($_POST['mes']=='02') {echo "selected";}?>>Fevereiro</option>
                        <option value="03" <?php if ($_POST['mes']=='03') {echo "selected";}?>>Março</option>
                        <option value="04" <?php if ($_POST['mes']=='04') {echo "selected";}?>>Abril</option>
                        <option value="05" <?php if ($_POST['mes']=='05') {echo "selected";}?>>Maio</option>
                        <option value="06" <?php if ($_POST['mes']=='06') {echo "selected";}?>>Junho</option>
                        <option value="07" <?php if ($_POST['mes']=='07') {echo "selected";}?>>Julho</option>
                        <option value="08" <?php if ($_POST['mes']=='08') {echo "selected";}?>>Agosto</option>
                        <option value="09" <?php if ($_POST['mes']=='09') {echo "selected";}?>>Setembro</option>
                        <option value="10" <?php if ($_POST['mes']=='10') {echo "selected";}?>>Outubro</option>
                        <option value="11" <?php if ($_POST['mes']=='11') {echo "selected";}?>>Novembro</option>
                        <option value="12" <?php if ($_POST['mes']=='12') {echo "selected";}?>>Dezembro</option>
                    </select>
                </td>
                <td width="40" align="right">Ano&nbsp;</td>
                <td>
                    <select name="ano">
                        <option value="0000" <?php if ($_POST['ano']=='0000') {echo "selected";}?>>Selecione</option>
                        <option value="2019" <?php if ($_POST['ano']=='2019') {echo "selected";}?>>2019</option>
                        <option value="2018" <?php if ($_POST['ano']=='2018') {echo "selected";}?>>2018</option>
                        <option value="2017" <?php if ($_POST['ano']=='2017') {echo "selected";}?>>2017</option>
                        <option value="2016" <?php if ($_POST['ano']=='2016') {echo "selected";}?>>2016</option>
                        <option value="2015" <?php if ($_POST['ano']=='2015') {echo "selected";}?>>2015</option>
                    </select>
                </td>
                <td width="140" align='center'><input type='hidden' name='search' value='0'><input class='button' type='Submit' value='Buscar'></td>
            </tr>
        </table>
    </form>

<?php


    if (isset($_POST['search'])) {

        if ($_POST['mes'] == "0" or $_POST['ano'] == "0") {
            echo "<br><br><font style='Arial' size='3' color='red'>Você NÃO selecionou um MÊS e/ou um ANO!<br><br><br><meta http-equiv='refresh' content='2;URL=pagamento.php'>";
        } else {

            ?>







            <center>
                <font size="2">Lista de Pagamentos</font>
                <table border="1" cellpadding="0" cellspacing="0"
                       style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
                    <tr height="30" bgcolor="#f0f8ff">
                        <td width="140" align="center">Cliente ID</td>
                        <td width="150" align="center">Data do Pagamento</td>
                        <td width="140" align="center">Plano</td>
                        <td width="30" align="center">RR</td>
                        <td width="140" align="center">Valor</td>
                    </tr>
                    <?php
                    $sql = "SELECT pag_cliente_id, pag_data, plan_nome, pag_reco, pag_pago 
                            FROM sm_pagamentos INNER JOIN sm_planos ON (sm_planos.plan_id = sm_pagamentos.pag_plan_id) 
                            WHERE date_format(pag_data,'%Y') = $_POST[ano] and date_format(pag_data,'%m') = $_POST[mes]
                            ORDER BY pag_cliente_id ASC LIMIT 10";
                    $consulta = mysqli_query($con, $sql) or die ("<font style=Arial color=red>Houve um erro na consulta dos dados</font>");

                    while ($dados = mysqli_fetch_array($consulta)) {
                        echo "<tr>
                        <td align='center'>" . $dados['pag_cliente_id'] . "</td>
                        <td align='center'>" . $dados['pag_data'] . "</td>
                        <td align='center'>" . $dados['plan_nome'] . "</td>
                        <td align='center'>" . $dados['pag_reco'] . "</td>
                        <td align='center'>R$ " . number_format($dados['pag_pago'], 2, ',', '.') . "</td>
                    </tr>";
                    }
                    mysqli_close($con);
                    ?>
                </table>
            </center>
            <?php


















        }

    } else {
        echo "<br><br><font style='Arial' size='3' color='#00008b'>Escolha o um mês e um ano.<br><br><br>";
    }
?>



<br>