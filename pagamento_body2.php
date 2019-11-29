<center>
    <br>

    <form action='pagamento.php' method='POST'>
        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
            <tr height="50" bgcolor="#f0f8ff">
                <td width="40" align="right">Mês&nbsp;</td>
                <td>
                    <select name="mes">
                        <option value="00" <?php if (isset($_POST['mes'])) {if ($_POST['mes']=='00' or $_POST['mes']=='') {echo "selected";}}?>>Selecione</option>
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
                <td>
                    <select name="ano">
                        <option value="0000" <?php if (isset($_POST['ano'])) {if ($_POST['ano']=='0000' or $_POST['ano']=='') {echo "selected";}}?>>Selecione</option>
                        <option value="2019" <?php if (isset($_POST['ano'])) {if ($_POST['ano']=='2019') {echo "selected";}}?>>2019</option>
                        <option value="2018" <?php if (isset($_POST['ano'])) {if ($_POST['ano']=='2018') {echo "selected";}}?>>2018</option>
                        <option value="2017" <?php if (isset($_POST['ano'])) {if ($_POST['ano']=='2017') {echo "selected";}}?>>2017</option>
                        <option value="2016" <?php if (isset($_POST['ano'])) {if ($_POST['ano']=='2016') {echo "selected";}}?>>2016</option>
                        <option value="2015" <?php if (isset($_POST['ano'])) {if ($_POST['ano']=='2015') {echo "selected";}}?>>2015</option>
                    </select>
                </td>
                <td width="140" align='center'><input type='hidden' name='search' value='0'><input class='button' type='Submit' value='Buscar'></td>
            </tr>
        </table>
    </form>

<?php

    if (isset($_POST['search'])) {

    if ($_POST['mes'] == "0" or $_POST['ano'] == "0") {
        echo "<br><br><font style='Arial' size='3' color='red'>Você NÃO selecionou um MÊS e/ou um ANO!<br><br><br>";
        echo "<meta http-equiv='refresh' content='2;URL=pagamento.php'>";
    } else {

?>




<!--

    <font size="2">Lista de Pagamentos</font>
    <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
        <tr height="30" bgcolor="#f0f8ff">
            <td width="140" align="center">Cliente ID</td>
            <td width="150" align="center">Data do Pagamento</td>
            <td width="140" align="center">Plano</td>
            <td width="30" align="center">RR</td>
            <td width="140" align="center">Valor</td>
        </tr>
    </table>
    <iframe width=606 height=200 src="pagamento_visoes.php?search=0&mes=<?php echo $_POST['mes']; ?>&ano=<?php echo $_POST['ano']; ?>" frameborder="0" noresize scrolling="yes"></iframe>
-->





















<?php
    }

    } else {
        echo "<br><br><font style='Arial' size='3' color='#00008b'>Escolha o um mês e um ano.<br><br><br>";
    }
?>


















    <br>
    <center>
        <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
            <tr height="30" bgcolor="#f0f8ff">
                <td width="80" align="center">Cliente ID</td>



            </tr>
            <?php
            $sql = "
                    SELECT pag_cliente_id
                    FROM sm_pagamentos
                    GROUP BY pag_cliente_id
                    ORDER BY pag_cliente_id
                    LIMIT 3
                    ";
            $consulta = mysqli_query($con, $sql) or die ("<font style=Arial color=red>Houve um erro na consulta 1 dos dados</font>"); $x=0;
            while ($dados = mysqli_fetch_array($consulta)) {


                echo "<tr><td align='center'>" . $dados['pag_cliente_id'] . "</td>";

                $sql2 = "
                          SELECT pag_data, pag_reco, pag_pago 
                          FROM sm_pagamentos 
                          WHERE pag_cliente_id = $dados[pag_cliente_id]
                          ORDER BY pag_data DESC";
                $consulta2=mysqli_query($con, $sql2) or die ("<font style=Arial color=red>Houve um erro na consulta 2 dos dados</font>");;
                while ($dados2 = mysqli_fetch_array($consulta2)) {
                    echo "<td align='center'>" . $dados2['pag_data'] . " | " . $dados2['pag_reco'] . " | " . $dados2['pag_pago'] . "</td>";
                } mysqli_free_result($consulta2);

                echo "</tr>";


                $x++; }
              if ($x==0) {echo "<br><br><font style='Arial' size='3' color='red'>Não há dados de pagamentos nesses período!<br><br><br>";}
            ?>
        </table>
    </center>





    <br>
    <center>
        <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
            <tr height="30" bgcolor="#f0f8ff">
                <td width="80" align="center">Cliente ID</td>



            </tr>
            <?php
            $sql = "
                    SELECT pag_cliente_id
                    FROM sm_pagamentos
                    GROUP BY pag_cliente_id
                    ORDER BY pag_cliente_id
                    LIMIT 3
                    ";
            $consulta = mysqli_query($con, $sql) or die ("<font style=Arial color=red>Houve um erro na consulta 1 dos dados</font>"); $x=0;
            while ($dados = mysqli_fetch_array($consulta)) {


                echo "<tr><td align='center'>" . $dados['pag_cliente_id'] . "</td>";

                $sql2 = "
                          SELECT pag_data, pag_reco, pag_pago 
                          FROM sm_pagamentos 
                          WHERE pag_cliente_id = $dados[pag_cliente_id] AND 
                          pag_data >= SUBDATE('2019-07-01 00:00:00', INTERVAL 6 MONTH)
                          ORDER BY pag_data ASC";
                $consulta2=mysqli_query($con, $sql2) or die ("<font style=Arial color=red>Houve um erro na consulta 2 dos dados</font>");;
                while ($dados2 = mysqli_fetch_array($consulta2)) {
                    echo "<td align='center'>" . $dados2['pag_data'] . " | " . $dados2['pag_reco'] . " | " . $dados2['pag_pago'] . "</td>";
                } mysqli_free_result($consulta2);

                echo "</tr>";


                $x++; }
            if ($x==0) {echo "<br><br><font style='Arial' size='3' color='red'>Não há dados de pagamentos nesses período!<br><br><br>";}
            ?>
        </table>
    </center>






    <br>
    <center>
        <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
            <tr height="30" bgcolor="#f0f8ff">
                <td witdh='150' align="center">ID Cli</td>
                <td witdh='150' align="center">Mês -6</td>
                <td witdh='150' align="center">Mês -5</td>
                <td witdh='150' align="center">Mês -4</td>
                <td witdh='150' align="center">Mês -3</td>
                <td witdh='150' align="center">Mês -2</td>
                <td witdh='150' align="center">Mês -1</td>
                <td witdh='150' align="center">Mês -0</td>
            </tr>
            <?php
            $mes=$_POST['mes'];
            $ano=$_POST['ano'];

            echo $mes." | ".$ano."<br>";

            $sql = "
                    SELECT pag_cliente_id
                    FROM sm_pagamentos
                    GROUP BY pag_cliente_id
                    ORDER BY pag_cliente_id
                    LIMIT 1
                    ";
            $consulta = mysqli_query($con, $sql) or die ("<font style=Arial color=red>Houve um erro na consulta 1 dos dados</font>"); $x=0;
            while ($dados = mysqli_fetch_array($consulta)) {





                $mes6=0;$mes5=0;$mes4=0;$mes3=0;$mes2=0;$mes1=0;$mes0=0;
                for ($x=7;$x>0;$x--) {


                    $sql2 = "
                              SELECT pag_data, pag_reco, pag_pago 
                              FROM sm_pagamentos 
                              WHERE pag_cliente_id = $dados[pag_cliente_id] AND 
                              MONTH(pag_data)=MONTH(ADDDATE('2019-07-01', INTERVAL -".$x." MONTH)) AND YEAR(pag_data)=YEAR(ADDDATE('2019-07-01', INTERVAL -".$x." MONTH))
                                       
                              ";
                    $consulta2=mysqli_query($con, $sql2) or die ("<font style=Arial color=red>Houve um erro na consulta 2 dos dados</font>");
                    $dados2 = mysqli_fetch_array($consulta2);


                        //list ($mes, $dia, $ano) = split ('[/.-]', $dados2['pag_data']);
                        echo $dados2['pag_data']."(".$dados2['pag_reco'].")<br>";



                }


                echo "  <tr>
                            <td align='center'>".$dados['pag_cliente_id']."</td>
                            <td align='center'>".$mes6."</td>
                            <td align='center'>".$mes5."</td>
                            <td align='center'>".$mes4."</td>
                            <td align='center'>".$mes3."</td>
                            <td align='center'>".$mes2."</td>
                            <td align='center'>".$mes1."</td>
                            <td align='center'>".$mes0."</td>
                        </tr>";









                $x++; } mysqli_free_result($consulta);
            mysqli_close($con); if ($x==0) {echo "<br><br><font style='Arial' size='3' color='red'>Não há dados de pagamentos nesses período!<br><br><br>";}
            ?>
        </table>
    </center>







<br><br>