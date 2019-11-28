<?php
if (isset($_POST['add'])) {
    $sql = "INSERT INTO se_sacola(scl_pdt_id,scl_desconto,scl_quantidade) VALUES ('$_POST[add]','$_POST[desconto]','$_POST[quantidade]')";
    mysqli_query($con, $sql) or die ("<font style=Arial color=red>Houve um erro na gravação dos dados</font>");
    mysqli_close($con);
    echo "<meta http-equiv='refresh' content='0;URL=venda.php'>";
}

if (isset($_GET['del'])) {
    $sql = "DELETE FROM se_sacola WHERE scl_id=$_GET[del]";
    mysqli_query($con, $sql) or die ("<font style=Arial color=red>Houve um erro na gravação dos dados</font>");
    mysqli_close($con);
    echo "<meta http-equiv='refresh' content='0;URL=venda.php'>";
}

if (isset($_POST['emp'])) {
    $sql = "INSERT INTO se_venda(vnd_data,vnd_total,vnd_repos,vnd_impos,vnd_lucro) VALUES ('$_POST[vt_data]','$_POST[vt_total]','$_POST[vt_repos]','$_POST[vt_impos]','$_POST[vt_lucro]')";
    mysqli_query($con, $sql) or die ("<font style=Arial color=red>Houve um erro na gravação dos dados</font>");
    mysqli_close($con);

    $sql = "TRUNCATE TABLE se_sacola";
    mysqli_query($con, $sql) or die ("<font style=Arial color=red>Houve um erro na gravação dos dados</font>");
    mysqli_close($con);

    echo "<meta http-equiv='refresh' content='0;URL=venda.php'>";
}

if (isset($_GET['src'])) {
    $sql = "SELECT * FROM se_produtos WHERE pdt_id=$_GET[src]";
    $consulta = mysqli_query($con, $sql);
    $dados = mysqli_fetch_array($consulta);

    $id = $dados['pdt_id'];
    $desc = $dados['pdt_desc'];
    $valor = $dados['pdt_valor'];

    mysqli_close($con);
} else {
    $id = "";
    $desc = "";
    $valor = "";
}
?>
<center>
    <br>
    <font size="2">Prateleira de Produtos</font>
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
    <tr height="30" bgcolor="#f0f8ff">
        <td width="29" align="center">N°</td>
        <td width="400">&nbsp;&nbsp;Descrição</td>
        <td width="80" align="center">Custo</td>
        <td width="60" align="center">Imp%</td>
        <td width="60" align="center">Margem</td>
        <td width="60" align="center">V. Unit</td>
        <td width="66" align="center">Opção</td>
    </tr>
</table>
    <iframe width=764 height=200 src="venda_prateleira.php" frameborder="0" noresize></iframe>
<br>
    <hr width="1000" color="#79B35F">
    <font size="2">Produto Selecionado</font>
<form name="form" action='venda.php' method='POST'>
    <table border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse">
        <tr>
            <td>
                <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
                    <tr>
                        <td width="70" align="right">Descrição:</td>
                        <td width="455"><input type="text" name="desc" maxlength="300" size="60" value="<?php echo utf8_encode($desc) ?>" readonly></td>
                        <td width="45" align="right">Valor:</td>
                        <td width="90"><input type="text" class="money" name="valor" maxlength="8" size="7" value="<?php echo $valor ?>" readonly></td>
                        <td width="70" align="right">Desconto:</td>
                        <td width="80"><input type="text" class="percent" name="desconto" maxlength="6" size="5" autofocus></td>
                        <td width="50" align="right">Quant:</td>
                        <td width="50"><input type="text" name="quantidade" maxlength="3" size="1" align="center"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse">
        <tr height="40">
            <td valign="bottom" align="center"><input type='hidden' name='add' value='<?php echo $id ?>'><input class='button' type='Submit' value='Empacotar'></td>
        </tr>
    </table>
</form>
<hr width="1000" color="#79B35F">
<font size="2">Sacola de Compras</font><br>
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
    <tr height="30" bgcolor="#f0f8ff">
        <td width="29" align="center">N°</td>
        <td width="400">&nbsp;&nbsp;Descrição</td>
        <td width="80" align="center">V. Custo</td>
        <td width="50" align="center">Qtd</td>
        <td width="60" align="center">Imp(%)</td>
        <td width="70" align="center">V. Imp</td>
        <td width="70" align="center">V. Total</td>
        <td width="60" align="center">Desc(%)</td>
        <td width="70" align="center">V. Final</td>
        <td width="57" align="center">Opção</td>
    </tr>
</table>
    <iframe width=957 height=150 src="venda_sacola.php" frameborder="0" noresize></iframe>
<br>
    <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; vertical-align: middle; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif">
        <?php
            $sql = "SELECT * FROM se_sacola order by scl_id ASC";
            $consulta=mysqli_query($con, $sql); $valor_total_venda="0";$valor_total_imposto="0";$valor_total_reposicao="0";$valor_total_lucro="0";
            while ($dados = mysqli_fetch_array($consulta)) {
                $sql2 = "SELECT * FROM se_produtos WHERE pdt_id = $dados[scl_pdt_id]";
                $consulta2=mysqli_query($con, $sql2);
                $dados2 = mysqli_fetch_array($consulta2);

                $valor_total_venda = $valor_total_venda + $dados['scl_quantidade'] * $dados2['pdt_valor'] * (((($dados2['pdt_pis'] + $dados2['pdt_cofins'] + $dados2['pdt_icms'] + $dados2['pdt_ipi']) + ($dados2['pdt_lucro'] - $dados['scl_desconto']))/100)+1);
                $valor_total_imposto = $valor_total_imposto + $dados['scl_quantidade'] * $dados2['pdt_valor'] * (($dados2['pdt_pis'] + $dados2['pdt_cofins'] + $dados2['pdt_icms'] + $dados2['pdt_ipi'])/100);
                $valor_total_reposicao = $valor_total_reposicao + $dados2['pdt_valor'] * $dados['scl_quantidade'];

            } mysqli_close($con);
        $valor_total_lucro = $valor_total_venda - $valor_total_imposto - $valor_total_reposicao;
        ?>
            <tr height="30" bgcolor="#f0f8ff">
                <td width="430" align="right">Valor Total dos Impostos&nbsp;</td>
                <td width="192" align="center"><?php echo "R$ ".number_format($valor_total_imposto, 2, ',', '.'); ?></td>
                <td width="141" align="right">Valor Total da Venda&nbsp;</td>
                <td width="190" align="center"><font size="4" color="red"><?php echo "R$ ".number_format($valor_total_venda, 2, ',', '.'); ?></font></td>
            </tr>
    </table>

    <form name="form" action='venda.php' method='POST'>
        <input type="hidden" name="vt_data" value="<?php echo time();?>">
        <input type="hidden" name="vt_total" value="<?php echo $valor_total_venda;?>">
        <input type="hidden" name="vt_repos" value="<?php echo $valor_total_reposicao;?>">
        <input type="hidden" name="vt_impos" value="<?php echo $valor_total_imposto;?>">
        <input type="hidden" name="vt_lucro" value="<?php echo $valor_total_lucro;?>">
        <table border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse">
            <tr height="40">
                <td valign="bottom" align="center"><input type='hidden' name='emp' value='1'><input class='button' type='Submit' value='Finalizar'></td>
            </tr>
        </table>
    </form>
</center>