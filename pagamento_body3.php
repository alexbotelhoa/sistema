<center>
    <br>
    <form action='pagamento3.php' method='POST'>
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
            echo "<meta http-equiv='refresh' content='2;URL=pagamento3.php'>";
        } else {
    ?>




    <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
        <tr height="30" bgcolor="#f0f8ff">
            <td width='60' align="center">ID</td>
            <td width='60' align="center">Mês-6</td>
            <td width='60' align="center">Mês-5</td>
            <td width='60' align="center">Mês-4</td>
            <td width='60' align="center">Mês-3</td>
            <td width='60' align="center">Mês-2</td>
            <td width='60' align="center">Mês-1</td>
            <td width='60' align="center">Mês-0</td>
        </tr>





        <?php
            $sql = "
                SELECT pag_cliente_id, count(1) as qtd
                FROM sm_pagamentos
                GROUP BY pag_cliente_id
                ORDER BY pag_cliente_id
                LIMIT 15, 5
                ";
            $consulta = mysqli_query($con, $sql) or die ("<font style=Arial color=red>Houve um erro na consulta 1 dos dados</font>"); $xx=0;
            $Tmrr0=0; $Tnew0=0; $Texpan0=0; $Tresur0=0; $Tcontr0=0; $Tcance0=0; $Tmrr1=0; $Tnew1=0; $Texpan1=0; $Tresur1=0; $Tcontr1=0; $Tcance1=0;
            while ($dados = mysqli_fetch_array($consulta)) {
                $mes7=0;$mes6=0;$mes5=0;$mes4=0;$mes3=0;$mes2=0;$mes1=0;$mes0=0; $r=array();

                //echo $dados['pag_cliente_id']." | ".$dados['qtd']."<br>";

                for ($x=7;$x>0;$x--) {
                    $sql2 = "
                      SELECT pag_data, pag_reco, pag_pago 
                      FROM sm_pagamentos 
                      WHERE pag_cliente_id = $dados[pag_cliente_id] AND 
                      MONTH(pag_data) = MONTH(ADDDATE('".$_POST['ano']."-".$_POST['mes']."-01', INTERVAL -".($x-1)." MONTH)) AND YEAR(pag_data) = YEAR(ADDDATE('".$_POST['ano']."-".$_POST['mes']."-31', INTERVAL -".($x-1)." MONTH))         
                      ";
                    $consulta2=mysqli_query($con, $sql2) or die ("<font style=Arial color=red>Houve um erro na consulta 2 dos dados</font>");
                    $dados2 = mysqli_fetch_array($consulta2);

                    //echo $x." | ".$dados2['pag_data']." | ".$dados2['pag_reco']." | ".$dados2['pag_pago']."<br>";

                    if ($dados2['pag_data']!="") {
                        $mm = round(($dados2['pag_pago']/$dados2['pag_reco']),2);

                        switch ($dados2['pag_reco']) {
                            case 1: $r[($x-1)]=$mm.$dados2['pag_reco']; break;
                            case 2: $r[($x-1)]=$r[($x-2)]=$mm.$dados2['pag_reco']; break;
                            case 3: $r[($x-1)]=$r[($x-2)]=$r[($x-3)]=$mm.$dados2['pag_reco']; break;
                            case 4: $r[($x-1)]=$r[($x-2)]=$r[($x-3)]=$r[($x-4)]=$mm.$dados2['pag_reco']; break;
                            case 5: $r[($x-1)]=$r[($x-2)]=$r[($x-3)]=$r[($x-4)]=$r[($x-5)]=$mm.$dados2['pag_reco']; break;
                            case 6: $r[($x-1)]=$r[($x-2)]=$r[($x-3)]=$r[($x-4)]=$r[($x-5)]=$r[($x-6)]=$mm.$dados2['pag_reco']; break;
                        }
                    } else {
                        if ($x == 7) {
                            $r[($x - 1)] = 0;
                        } else {
                            if ($r[$x] != 0) {
                                $r[($x - 1)] = $r[$x];
                            } else {
                                $r[($x - 1)] = 0;
                            }
                        }
                    }
                }





                echo "<tr>
                        <td align='center'>" . $dados['pag_cliente_id'] . "</td>
                        <td align='center'>" . $r[6]. "</td>
                        <td align='center'>" . $r[5]. "</td>
                        <td align='center'>" . $r[4]. "</td>
                        <td align='center'>" . $r[3]. "</td>
                        <td align='center'>" . $r[2]. "</td>
                        <td align='center'>" . $r[1]. "</td>
                        <td align='center'>" . $r[0]. "</td>
                    </tr>";






                if ($r[0]!=0) {$mrr0=$r[0];} else {$mrr0=0;}
                if ($r[1]==0 and $dados['qtd']==1 and $r[0]>0) {$new0=$r[0];} else {$new0=0;}
                if ($r[1]!=0 and $r[0]!=0 and $r[1]<$r[0]) {$expan0=$r[0]-$r[1];} else {$expan0=0;}
                if ($r[1]==0 and $dados['qtd']>1 and $r[0]>0) {$resur0=$r[0];} else {$resur0=0;}
                if ($r[1]!=0 and $r[0]!=0 and $r[1]>$r[0]) {$contr0=$r[0]-$r[1];} else {$contr0=0;}
                if ($r[1]>0 and $r[0]==0) {$cance0=$r[0];} else {$cance0=0;}

                $Tmrr0 = $Tmrr0 + $mrr0;
                $Tnew0 = $Tnew0 + $new0;
                if ($expan0 < 0){$expan0=$expan0*-1;}$Texpan0 = $Texpan0 + $expan0;
                $Tresur0 = $Tresur0 + $resur0;
                if ($contr0 < 0){$contr0=$contr0*-1;}$Tcontr0 = $Tcontr0 + $contr0;
                $Tcance0 = $Tcance0 + $cance0;

                if ($r[1]!=0) {$mrr1=$r[1];} else {$mrr1=0;}
                if ($r[2]==0 and $dados['qtd']==1 and $r[1]>0) {$new1=$r[1];} else {$new1=0;}
                if ($r[2]!=0 and $r[1]!=0 and $r[2]<$r[1]) {$expan1=$r[1]-$r[2];} else {$expan1=0;}
                if ($r[2]==0 and $dados['qtd']>1 and $r[1]>0) {$resur1=$r[1];} else {$resur1=0;}
                if ($r[2]!=0 and $r[1]!=0 and $r[2]>$r[1]) {$contr1=$r[1]-$r[2];} else {$contr1=0;}
                if ($r[2]>0 and $r[1]==0) {$cance1=$r[1];} else {$cance1=0;}

                $Tmrr1 = $Tmrr1 + $mrr1;
                $Tnew1 = $Tnew1 + $new1;
                if ($expan1 < 0){$expan1=$expan1*-1;}$Texpan1 = $Texpan1 + $expan1;
                $Tresur1 = $Tresur1 + $resur1;
                if ($contr1 < 0){$contr1=$contr1*-1;}$Tcontr1 = $Tcontr1 + $contr1;
                $Tcance1 = $Tcance1 + $cance1;

                $xx++;
            } mysqli_free_result($consulta);
            mysqli_close($con); if ($xx==0) {echo "<br><br><font style='Arial' size='3' color='red'>Não há dados de pagamentos nesses período!<br><br><br>";}
        ?>
    </table>
    <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
        <tr height="30" bgcolor="#f0f8ff">
            <td width='150' align="center">Métricas</td>
            <td width='100' align="center">Mês Anterior</td>
            <td width='100' align="center">Mês Atual</td>
            <td width='100' align="center">Resultado</td>
        </tr>
        <tr height="30" bgcolor="#f0f8ff">
            <td align="left">MRR</td>
            <td align="center"><?php echo $Tmrr1; ?></td>
            <td align="center"><?php echo $Tmrr0; ?></td>
            <td align="center"><?php echo $Tmrr0-$Tmrr1; ?></td>
        </tr>
        <tr height="30" bgcolor="#f0f8ff">
            <td align="left">New MRR</td>
            <td align="center"><?php echo $Tnew1; ?></td>
            <td align="center"><?php echo $Tnew0; ?></td>
            <td align="center"><?php echo $Tnew0-$Tnew1; ?></td>
        </tr>
        <tr height="30" bgcolor="#f0f8ff">
            <td align="left">Expansion MRR</td>
            <td align="center"><?php echo $Texpan1; ?></td>
            <td align="center"><?php echo $Texpan0; ?></td>
            <td align="center"><?php echo $Texpan0-$Texpan1; ?></td>
        </tr>
        <tr height="30" bgcolor="#f0f8ff">
            <td align="left">Resurrected MRR</td>
            <td align="center"><?php echo $Tresur1; ?></td>
            <td align="center"><?php echo $Tresur0; ?></td>
            <td align="center"><?php echo $Tresur0-$Tresur1; ?></td>
        </tr>
        <tr height="30" bgcolor="#f0f8ff">
            <td align="left">Contration MRR</td>
            <td align="center"><?php echo $Tcontr1; ?></td>
            <td align="center"><?php echo $Tcontr0; ?></td>
            <td align="center"><?php echo $Tcontr0-$Tcontr1; ?></td>
        </tr>
        <tr height="30" bgcolor="#f0f8ff">
            <td align="left">Cancelled MRR</td>
            <td align="center"><?php echo $Tcance1; ?></td>
            <td align="center"><?php echo $Tcance0; ?></td>
            <td align="center"><?php echo $Tcance0-$Tcance1; ?></td>
        </tr>
    </table>
</center>
<?php
        }
    } else {
        echo "<br><br><font style='Arial' size='3' color='#00008b'>Escolha o um mês e um ano.<br><br><br>";
    }
?>
<br>