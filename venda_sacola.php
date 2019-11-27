<?php include 'conexao.php';?>
<style type="text/css">
    body{
        margin: 0px 0px 0px 0px;
        padding: 0;
    }
</style>
<center>
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
    <?php
    $sql = "SELECT * FROM se_sacola order by scl_id ASC";
    $consulta=mysqli_query($con, $sql) or die (); $x="1";
    while ($dados = mysqli_fetch_array($consulta)) {
        $sql2 = "SELECT * FROM se_produtos WHERE pdt_id = $dados[scl_pdt_id]";
        $consulta2=mysqli_query($con, $sql2) or die ();
        $dados2 = mysqli_fetch_array($consulta2);
        $valor_venda = $dados['scl_quantidade'] * ($dados2['pdt_valor'] * (((($dados2['pdt_pis'] + $dados2['pdt_cofins'] + $dados2['pdt_icms'] + $dados2['pdt_ipi']) + $dados2['pdt_lucro'])/100)+1));
        $valor_final = $dados['scl_quantidade'] * ($dados2['pdt_valor'] * (((($dados2['pdt_pis'] + $dados2['pdt_cofins'] + $dados2['pdt_icms'] + $dados2['pdt_ipi']) + ($dados2['pdt_lucro'] - $dados['scl_desconto']))/100)+1));

        echo "<tr>
                    <td width='30' align='center'>".$x."</td>
                    <td width='400'>&nbsp;&nbsp;".utf8_encode($dados2['pdt_desc'])."</td>
                    <td width='80' align='center'>".number_format($dados2['pdt_valor'], 2, ',', '.')."</td>
                    <td width='50' align='center'>".$dados['scl_quantidade']."</td>
                    <td width='60' align='center'>".str_replace(".", ",", ($dados2['pdt_pis'] + $dados2['pdt_cofins'] + $dados2['pdt_icms'] + $dados2['pdt_ipi']))."</td>
                    <td width='70' align='center'>".number_format(($dados2['pdt_valor'] * (($dados2['pdt_pis'] + $dados2['pdt_cofins'] + $dados2['pdt_icms'] + $dados2['pdt_ipi'])/100) * $dados['scl_quantidade']), 2, ',', '.')."</td>
                    <td width='70' align='center'>".number_format($valor_venda, 2, ',', '.')."</td>               
                    <td width='60' align='center'>".str_replace(".", ",", $dados['scl_desconto'])."</td>
                    <td width='70' align='center'>".number_format($valor_final,2, ',', '.')."</td>
                    <td width='40' align='center'><a href='venda.php?del=".$dados['scl_id']."' target='sacola'><img src='imagens/site/del.png'></a></td>
                </tr>";
        $x++;} mysqli_close($con);
    ?>
</table>
</center>
