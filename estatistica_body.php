<center><br>
    <form action='estatistica.php' method='POST'>
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
            echo "<meta http-equiv='refresh' content='2;URL=estatistica.php'>";
        } else {
            $sql = "
                SELECT pag_cliente_id, GROUP_CONCAT(CONCAT_WS(',', pag_data, pag_reco, round((pag_pago/pag_reco))) ORDER BY pag_data ASC SEPARATOR '/') as informacoes, count(1) as contador
                FROM sm_pagamentos
                WHERE pag_data BETWEEN ADDDATE('".$_POST['ano']."-".$_POST['mes']."-01', INTERVAL -6 MONTH) AND '".$_POST['ano']."-".$_POST['mes']."-31'
                GROUP BY pag_cliente_id
                ORDER BY pag_cliente_id ASC
                ";
            $consulta = mysqli_query($con, $sql) or die ("<font style=Arial color=red>Houve um erro na consulta 1 dos dados</font>");
            $Tmrr0=0; $Tnew0=0; $Texpan0=0; $Tresur0=0; $Tcontr0=0; $Tcance0=0; $Tmrr1=0; $Tnew1=0; $Texpan1=0; $Tresur1=0; $Tcontr1=0; $Tcance1=0; $x=0;
            while ($dados = mysqli_fetch_array($consulta)) {
                $mes[6]=0;$mes[5]=0;$mes[4]=0;$mes[3]=0;$mes[2]=0;$mes[1]=0;$mes[0]=0;
                $infoPag = explode('/', $dados['informacoes']);

                for ($d=0;$d<count($infoPag);$d++) {
                    $infoDados = explode(',', $infoPag[$d]);
                    $dia = explode('-',$infoDados[0]);
                    $diff = dataDiff($infoDados[0],$_POST['ano'].'-'.$_POST['mes'].'-'.$dia[2]);

                    switch ($infoDados[1]) {
                        case 1: $mes[$diff]=$infoDados[2]; break;
                        case 2: $mes[$diff]=$mes[($diff-1)]=$infoDados[2]; break;
                        case 3: $mes[$diff]=$mes[($diff-1)]=$mes[($diff-2)]=$infoDados[2]; break;
                        case 4: $mes[$diff]=$mes[($diff-1)]=$mes[($diff-2)]=$mes[($diff-3)]=$infoDados[2]; break;
                        case 5: $mes[$diff]=$mes[($diff-1)]=$mes[($diff-2)]=$mes[($diff-3)]=$mes[($diff-4)]=$infoDados[2]; break;
                        case 6: $mes[$diff]=$mes[($diff-1)]=$mes[($diff-2)]=$mes[($diff-3)]=$mes[($diff-4)]=$mes[($diff-5)]=$infoDados[2]; break;
                    }
                }

                if ($mes[0]!=0) {$mrr0=$mes[0];} else {$mrr0=0;}
                if ($mes[1]==0 and $dados['contador']==1 and $mes[0]>0) {$new0=$mes[0];} else {$new0=0;}
                if ($mes[1]!=0 and $mes[0]!=0 and $mes[1]<$mes[0]) {$expan0=$mes[0]-$mes[1];} else {$expan0=0;}
                if ($mes[1]==0 and $dados['contador']>1 and $mes[0]>0) {$resur0=$mes[0];} else {$resur0=0;}
                if ($mes[1]!=0 and $mes[0]!=0 and $mes[1]>$mes[0]) {$contr0=$mes[0]-$mes[1];} else {$contr0=0;}
                if ($mes[1]>0 and $mes[0]==0) {$cance0=$mes[0];} else {$cance0=0;}

                $Tmrr0 = $Tmrr0 + $mrr0;
                $Tnew0 = $Tnew0 + $new0;
                if ($expan0 < 0){$expan0=$expan0*-1;}$Texpan0 = $Texpan0 + $expan0;
                $Tresur0 = $Tresur0 + $resur0;
                if ($contr0 < 0){$contr0=$contr0*-1;}$Tcontr0 = $Tcontr0 + $contr0;
                $Tcance0 = $Tcance0 + $cance0;

                if ($mes[1]!=0) {$mrr1=$mes[1];} else {$mrr1=0;}
                if ($mes[2]==0 and $dados['contador']==1 and $mes[1]>0) {$new1=$mes[1];} else {$new1=0;}
                if ($mes[2]!=0 and $mes[1]!=0 and $mes[2]<$mes[1]) {$expan1=$mes[1]-$mes[2];} else {$expan1=0;}
                if ($mes[2]==0 and $dados['contador']>1 and $mes[1]>0) {$resur1=$mes[1];} else {$resur1=0;}
                if ($mes[2]!=0 and $mes[1]!=0 and $mes[2]>$mes[1]) {$contr1=$mes[1]-$mes[2];} else {$contr1=0;}
                if ($mes[2]>0 and $mes[1]==0) {$cance1=$mes[1];} else {$cance1=0;}

                $Tmrr1 = $Tmrr1 + $mrr1;
                $Tnew1 = $Tnew1 + $new1;
                if ($expan1 < 0){$expan1=$expan1*-1;}$Texpan1 = $Texpan1 + $expan1;
                $Tresur1 = $Tresur1 + $resur1;
                if ($contr1 < 0){$contr1=$contr1*-1;}$Tcontr1 = $Tcontr1 + $contr1;
                $Tcance1 = $Tcance1 + $cance1;

                $x++;
            } mysqli_free_result($consulta); mysqli_close($con);
            if ($x==0) {echo "<br><br><font style='Arial' size='3' color='red'>Não há dados de pagamentos nesses período!<br><br><br>";}
            ?>
            <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
                <tr height="30" bgcolor="#f0f8ff">
                    <td width='150' align="center">Métricas</td>
                    <td width='100' align="center"><?php echo date("M/Y", strtotime($_POST['ano']."-".($_POST['mes']-1)."-01 00:00:00"));?></td>
                    <td width='100' align="center"><?php echo date("M/Y", strtotime($_POST['ano']."-".$_POST['mes']."-01 00:00:00"));?></td>
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
            <?php
        }
    } else {
        echo "<br><br><font style='Arial' size='3' color='#00008b'>Escolha o um mês e um ano.<br><br><br>";
    }
?>
</center><br>