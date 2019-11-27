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
        $sql = "SELECT * FROM se_produtos order by pdt_desc ASC";
        $consulta=mysqli_query($con, $sql); $x="1";
        while ($dados = mysqli_fetch_array($consulta)) {

            $valor_custo = $dados['pdt_valor'];
            $impostos = $dados['pdt_pis'] + $dados['pdt_cofins'] + $dados['pdt_icms'] + $dados['pdt_ipi'];
            $valor_venda = $valor_custo * ((($impostos + $dados['pdt_lucro'])/100)+1);

            echo "<tr>
                    <td width='30' align='center'>".$x."</td>
                    <td width='400'>&nbsp;&nbsp;".utf8_encode($dados['pdt_desc'])."</td>
                    <td width='80' align='center'>".number_format($valor_custo, 2, ',', '.')."</td>
                    <td width='60' align='center'>".$impostos."</td>
                    <td width='60' align='center'>".$dados['pdt_lucro']."</td>
                    <td width='60' align='center'>".number_format($valor_venda, 2, ',', '.')."</td>
                    <td width='50' align='center'><a href='venda.php?src=".$dados['pdt_id']."' target='prateleira'><img src='imagens/site/add.png'></a></td>
                </tr>";
            $x++;} mysqli_close($con);
        ?>
    </table>
</center>