<?php include 'conexao.php';?>
<style type="text/css">
    body{
        margin: 0px 0px 0px 0px;
        padding: 0;
    }
</style>



<?php if (isset($_GET['search'])) { ?>
    <center>
        <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
            <?php
            $sql = "SELECT pag_cliente_id, pag_data, plan_nome, pag_reco, pag_pago 
                            FROM sm_pagamentos INNER JOIN sm_planos ON (sm_planos.plan_id = sm_pagamentos.pag_plan_id) 
                            WHERE date_format(pag_data,'%Y') = $_GET[ano] and date_format(pag_data,'%m') = $_GET[mes]
                            ORDER BY pag_cliente_id ASC LIMIT 20";
            $consulta = mysqli_query($con, $sql) or die ("<font style=Arial color=red>Houve um erro na consulta dos dados</font>"); $x=0;

            while ($dados = mysqli_fetch_array($consulta)) {
                echo "<tr>
                        <td width='140' align='center'>" . $dados['pag_cliente_id'] . "</td>
                        <td width='150' align='center'>" . $dados['pag_data'] . "</td>
                        <td width='140' align='center'>" . $dados['plan_nome'] . "</td>
                        <td width='30' align='center'>" . $dados['pag_reco'] . "</td>
                        <td width='123' align='center'>R$ " . number_format($dados['pag_pago'], 2, ',', '.') . "</td>
                    </tr>";
            $x++;}
            mysqli_close($con); if ($x==0) {echo "<br><br><font style='Arial' size='3' color='red'>Não há dados de pagamentos nesses período!<br><br><br>";}
            ?>
        </table>
    </center>
<?php } ?>
